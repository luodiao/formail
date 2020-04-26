<?php

namespace app\admin\model;

use think\Model;
use \app\admin\model\WxEs;
use \app\admin\model\YyznUsers;
use \app\admin\model\OrderDiscount;
use \app\admin\model\User;

class YyznWorks extends Model
{

    //数据库
    protected $connection = 'yyzn';
    // 表名
    protected $name = 'yyzn_works';
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->YyznUsers = new YyznUsers();
        $this->WxEs = new WxEs();
        
    }

    // 追加属性
    protected $append = [
        'type_text',
        'status_text',
        'assigntime_text'
    ];

    

    public function getTypeList()
    {
        return ['1' => __('Type 1'), '2' => __('Type 2'), '3' => __('Type 3')];
    }

    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1'), '2' => __('Status 2')];
    }


    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['work_status']) ? $data['work_status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getAssigntimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['assigntime']) ? $data['assigntime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setAssigntimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
