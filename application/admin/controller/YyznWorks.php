<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use app\admin\library\Auth;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;
use think\Request;


/**
 * 
 *
 * @icon fa fa-circle-o
 */
class YyznWorks extends Backend
{
    
    /**
     * YyznWorks模型对象
     * @var \app\admin\model\YyznWorks
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\YyznWorks;
        $this->adminModel = new \app\admin\model\Admin;
        $this->usermodel = new \app\admin\model\YyznUsers;
        $this->view->assign("typeList", $this->model->getTypeList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->authinfomodel = new \app\admin\model\WxActivitiesAuthsInfo;
        $this->view->assign("authList", $this->authinfomodel->getAidList());
        $this->wxmodel = new \app\admin\model\Wxes;
        $this->logmodel = new \app\admin\model\YyznWorklog;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->alias('w')
                ->join('users u','u.id=w.user_id','LEFT')
                ->where($where)
                ->where('u.mobile','>',0)
                ->order('w.id', $order)
                ->count();
            $list = $this->model
                ->alias('w')
                ->field('w.id,u.image,u.username,u.mobile,w.type,w.desc,w.auth,w.wxname,w.createtime,w.admin_id,w.work_status,w.assigntime')
                ->join('users u','u.id=w.user_id','LEFT')
                ->where($where)
                ->where('u.mobile','>',0)
                ->order('w.id', $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            foreach ($list as $key => &$value) {
                if($value['admin_id'] > 0){
                    $value['admin_username'] = $this->adminModel->where('id',$value['admin_id'])->value('nickname');
                }else{
                    $value['admin_username'] = null;
                }
            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }
    //添加客情
    public function add($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    $logData = array(
                        'fk_work_id' => $ids,
                        'work_status' => $params['work_status'],
                        'admin_id' => $this->auth->id,
                        'admin_name' => $this->auth->nickname,
                        'fk_user_id' => $row->user_id,
                        'desc' => $params['new_desc'],
                        'createtime' => time(),
                        );
                    $this->logmodel->allowField(true)->save($logData);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign('list',$row);
        $user_row = $this->usermodel->get($row->user_id);
        $this->view->assign('user_row',$user_row);
        $info_row = $this->authinfomodel->where('fk_user_id',$row->user_id)->select();
        foreach ($info_row as $key => $info_value) {
            if($info_value->fk_id == 4 || $info_value->fk_id == 5){
                $info_value->wx_name = null;
            }else{
              $info_value->wx_name = $this->wxmodel->where('id',$info_value->wx_id)->value('name');  
            }
        }
        $this->view->assign('info_row',$info_row);
        $this->view->assign('time',time());
        $log_row = $this->logmodel->where('fk_user_id',$row->user_id)->order('id','desc')->select();
        $this->view->assign('log_row',$log_row);
        return $this->view->fetch();
    }

    /**
     * 查看
     */
    public function indexuser()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->alias('w')
                ->join('users u','u.id=w.user_id','LEFT')
                ->where($where)
                ->where('u.mobile','>',0)
                ->where('w.admin_id',$this->auth->id)
                ->order('w.id', $order)
                ->count();
            $list = $this->model
                ->alias('w')
                ->field('w.id,u.image,u.username,u.mobile,w.type,w.desc,w.auth,w.wxname,w.createtime,w.admin_id,w.work_status,w.assigntime')
                ->join('users u','u.id=w.user_id','LEFT')
                ->where($where)
                ->where('u.mobile','>',0)
                ->where('w.admin_id',$this->auth->id)
                ->order('w.id', $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            foreach ($list as $key => &$value) {
                if($value['admin_id'] > 0){
                    $value['admin_username'] = $this->adminModel->where('id',$value['admin_id'])->value('nickname');
                }else{
                    $value['admin_username'] = null;
                }
            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }
    //添加客情
    public function adduser($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    $logData = array(
                        'fk_work_id' => $ids,
                        'work_status' => $params['work_status'],
                        'admin_id' => $this->auth->id,
                        'admin_name' => $this->auth->nickname,
                        'fk_user_id' => $row->user_id,
                        'desc' => $params['new_desc'],
                        'createtime' => time(),
                        );
                    $this->logmodel->allowField(true)->save($logData);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign('list',$row);
        $user_row = $this->usermodel->get($row->user_id);
        $this->view->assign('user_row',$user_row);
        $info_row = $this->authinfomodel->where('fk_user_id',$row->user_id)->select();
        foreach ($info_row as $key => $info_value) {
            if($info_value->fk_id == 4 || $info_value->fk_id == 5){
                $info_value->wx_name = null;
            }else{
              $info_value->wx_name = $this->wxmodel->where('id',$info_value->wx_id)->value('name');  
            }
        }
        $this->view->assign('info_row',$info_row);
        $this->view->assign('time',time());
        $log_row = $this->logmodel->where('fk_user_id',$row->user_id)->order('id','desc')->select();
        $this->view->assign('log_row',$log_row);
        return $this->view->fetch();
    }

    public function edit($ids = null)
    {
        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $params['assigntime'] = time();
                    $result = $row->allowField(true)->save($params);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $userList = $this->adminModel->select();
        $this->view->assign('userList',$userList);
        $this->view->assign('list',$row);
        return $this->view->fetch(); 
    }

}
