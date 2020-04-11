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
class Authinfolog extends Backend
{
    
    /**
     * Authinfolog模型对象
     * @var \app\admin\model\Authinfolog
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Authinfolog;
        $this->authinfomodel = new \app\admin\model\WxActivitiesAuthsInfo;
        $this->WxEs = new \app\admin\model\WxEs;
        $this->YyznUsers = new \app\admin\model\YyznUsers;

        $this->view->assign("authList", $this->model->getAuthList());
        $this->view->assign("typeList", $this->model->getTypeList());
        $this->view->assign("levelList", $this->model->getLevelList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
    public function index()
    {
        //设置过滤方法
        $time = 86400 *30;
        $start_ed = time() -$time;
        $end_ed = time() + $time;
        $filter = json_decode($_REQUEST['filter'],true);
        $start_ed = strtotime(date("Y-m-d 00:00:00",$start_ed));
        $end_ed = strtotime(date("Y-m-d 23:59:59",$end_ed));

        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            

            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->authinfomodel
                ->where($where)
                ->where('validity_dt','>',$start_ed)
                ->where('validity_dt','<=',$end_ed)
                ->order($sort, $order)
                ->count();

            $list = $this->authinfomodel
                ->where($where)
                ->where('validity_dt','>',$start_ed)
                ->where('validity_dt','<=',$end_ed)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    //回访管理
    public function loglist(){
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
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch('authinfolog/index');
    }

    /**
     * 添加
     */
    public function add($ids = null)
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);

                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                $params['admin_id'] = $this->auth->id;
                $params['adminname'] = $this->auth->nickname;
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
        $list = $this->authinfomodel
                ->where('id',$ids)->find()->toArray();
        //查询公众号信息
        $wechat = array(
            'id' => 0,
            'name' => ''
        );
        if($list['fk_id'] < 4){
            $wechat = $this->WxEs->where('id',$list['wx_id'])->find()->toArray();
        }
        //查询用户信息
        $user = $this->YyznUsers->where('id',$list['fk_user_id'])->find()->toArray();
        $this->view->assign("wechat", $wechat);
        $this->view->assign("list", $list);
        $this->view->assign("user", $user);
        return $this->view->fetch();
    }

    public function logslist($ids = null){
        $list = $this->authinfomodel
                ->where('id',$ids)->find()->toArray();
        $model = $this->model;
        if($list['fk_id'] > 3){
            $model->where('user_id',$list['fk_user_id'])
            ->where('auth',$list['fk_id']);
        }else{
            $model->where('wx_id',$list['wx_id'])
            ->where('auth',$list['fk_id']);
        }
        $listlog = $model->order('desc', 'id')
                ->select();
        $this->view->assign("list", $listlog);

        return $this->view->fetch();
    }
}
