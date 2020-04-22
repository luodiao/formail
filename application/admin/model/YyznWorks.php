<?php

namespace app\admin\model;

use think\Model;


class YyznWorks extends Model
{

    
//数据库
    protected $connection = 'yyzn';
    // 表名
    protected $name = 'yyzn_works';

    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->YyznUsers = new YyznUsers();
        $this->WxEs = new WxEs();
        $this->OrderDiscount = new OrderDiscount();
        $this->User = new User();
    }
    // 追加属性
    protected $append = [
        'type_text',
        'status_text',
        'user_name',
        'assigntime_text'
    ];
    
    public function getUserName($user_id){
        return $this->YyznUsers->where('id',$user_id)->value('username');
    }

    public function getUserNameAttr($value,$data){
        $value = $value ? $value : (isset($data['fk_user_id']) ? $data['fk_user_id'] : '');
        if($value > 0){
            return $this->getUserName($value);
        }
        return null;
    }

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
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
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
