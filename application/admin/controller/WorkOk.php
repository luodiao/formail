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
class WorkOk extends Backend
{
    
    /**
     * WorkOk模型对象
     * @var \app\admin\model\WorkOk
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\WorkOk;
        $this->Adminmodel = new \app\admin\model\Admin;
        $this->WorkMdel = new \app\admin\model\Work;
        $this->view->assign("wechatTypeList", $this->model->getWechatTypeList());
        $this->view->assign("industryTypeList", $this->model->getIndustryTypeList());
        $this->view->assign("projectList", $this->model->getProjectList());
        $this->view->assign("statusList", $this->model->getStatusList());
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
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            // var_dump($list);exit;
            foreach ($list as $key => &$value) {
                $obj = $this->Adminmodel->where('id',$value['admin_id'])->find();
                $value['admin_text'] = $obj->nickname;

            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $params['admin_id'] = $this->auth->id;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
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
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
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
                    if($params['status'] == 2){
                        $user =  \app\admin\model\Work::withTrashed(true)->where('id', $row->work_id)->update(['deletetime' => null]);;
                    }
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
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    /**
     * 查看
     */
    public function yeji()
    {   
        
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            // echo $_GET['filter'];
            $_REQUEST['filter'] = '{"admin_id":"2"}';
            // $this->get = $_REQUEST;
            // $this->request->get=$_REQUEST;
            $_REQUEST['op'] = '{"admin_id":"="}';
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            // echo "<pre>";
            // var_dump($where::['static']);exit;
            $total = $this->model
                ->where($where)
                ->where('status',3)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->where('status',3)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            // var_dump($list);exit;
            foreach ($list as $key => &$value) {
                $obj = $this->Adminmodel->where('id',$value['admin_id'])->find();
                $value['admin_text'] = $obj->nickname;

            }
            $w = strtotime(date('Y-m-d', time()-86400*date('w')+(date('w')>0?86400:-6*86400)));
            $m = strtotime(date('Y-m-01', strtotime(date("Y-m-d"))));
            $j = strtotime(date('Y-m-d', mktime(0,0,0,date('n')-(date('n')-1)%3,1,date('Y'))));
            //数据统计
            $condition['status'] = 3;
            $filter = json_decode($_GET['filter'],true);
            if(isset($filter['admin_id'])){
                $condition['admin_id'] = $filter['admin_id'];
            }
            $condition['open_time'] = array('egt',$w);
            $count['w'] = $this->model
                ->where($condition)
                ->sum('price');

            $condition['open_time'] = array('egt',$m);
            $count['m'] = $this->model
                ->where($condition)
                ->sum('price');
            $count['ok_cj'] = $this->model
                ->where($condition)
                ->count();

            $condition['open_time'] = array('egt',$j);
            $count['j'] = $this->model
                ->where($condition)
                ->sum('price');
            $no_condition = array();
            if(isset($filter['admin_id'])){
                $no_condition['admin_id'] = $filter['admin_id'];
            }
            $count['no_cj'] = $this->WorkMdel->where($no_condition)->count();
            $count['cj_bfl'] = 0;
            if($count['ok_cj']>0){
                $count['cj_bfl'] = intval($count['ok_cj'] / ($count['no_cj']+$count['ok_cj'])*10000) / 100;
            }
            
            $result = array("total" => $total, "rows" => $list,'count'=>$count);

            return json($result);
        }

        return $this->view->fetch();
    }

    /**
     * 查看
     */
    public function yejiing()
    {   
        
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            // echo $_GET['filter'];
            $_REQUEST['filter'] = '{"admin_id":"2"}';
            // $this->get = $_REQUEST;
            // $this->request->get=$_REQUEST;
            $_REQUEST['op'] = '{"admin_id":"="}';
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            // echo "<pre>";
            // var_dump($where::['static']);exit;
            $total = $this->model
                ->where($where)
                ->where('status',3)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($where)
                ->where('status',3)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            // var_dump($list);exit;
            foreach ($list as $key => &$value) {
                $obj = $this->Adminmodel->where('id',$value['admin_id'])->find();
                $value['admin_text'] = $obj->nickname;

            }
            
            
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        $w = strtotime(date('Y-m-d', time()-86400*date('w')+(date('w')>0?86400:-6*86400)));
            $m = strtotime(date('Y-m-01', strtotime(date("Y-m-d"))));
            $j = strtotime(date('Y-m-d', mktime(0,0,0,date('n')-(date('n')-1)%3,1,date('Y'))));
        //数据统计
        $condition['status'] = 3;
        $condition['admin_id'] = $this->auth->id;

        $condition['open_time'] = array('egt',$w);
        $count['w'] = $this->model
            ->where($condition)
            ->sum('price');

        $condition['open_time'] = array('egt',$m);
        $count['m'] = $this->model
            ->where($condition)
            ->sum('price');
        $count['ok_cj'] = $this->model
            ->where($condition)
            ->count();

        $condition['open_time'] = array('egt',$j);
        $count['j'] = $this->model
            ->where($condition)
            ->sum('price');
        $no_condition['admin_id'] = $this->auth->id;

        $count['no_cj'] = $this->WorkMdel->where($no_condition)->count();
        $count['cj_bfl'] = 0;
        if($count['ok_cj']>0){
            $count['cj_bfl'] = intval($count['ok_cj'] / ($count['no_cj']+$count['ok_cj'])*10000) / 100;
        }
        $this->assign('count',$count);
        return $this->view->fetch();
    }
}
