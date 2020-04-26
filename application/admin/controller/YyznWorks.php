<?php

namespace app\admin\controller;

use app\common\controller\Backend;

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
            
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    /**
     * 添加管理员
     */
    public function adduser($ids = null)
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
        $list = $this->model
                ->where('id',$ids)->find()->toArray();
        $listlog = $this->adminModel->order('desc', 'id')
                ->select();
        $this->view->assign('userList',$userList);
        $this->view->assign('list',$list);
        return $this->view->fetch();
    }

}
