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
        $this->relationSearch = true;
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $whereis['id']  = array('EXP',' is not NULL');
            $total = $this->model
                ->alias('w')
                ->join('users u','u.id=w.user_id','LEFT')
                // ->with('userdetail')
                ->where($where)
                // ->where($whereis)
                ->order('u.id', $order)
                // ->order($sort, $order)
                ->count();
                echo $this->getLastSql();exit;
            $list = $this->model
                ->with('userdetail')
                ->where($where)
                ->where($whereis)
                ->order('id', $order)
                ->limit($offset, $limit)
                ->select();

            $list = collection($list)->toArray();
            
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

}
