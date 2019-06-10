<?php

namespace app\admin\model;

use think\Model;


class NewWechatUser extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'new_wechat_user';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'status_text',
        'qrcodetime_text'
    ];
    

    
    public function getStatusList()
    {
        return ['0' => __('Status 0'), '1' => __('Status 1'), '2' => __('Status 2'), '3' => __('Status 3')];
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getQrcodetimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['qrcodetime']) ? $data['qrcodetime'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setQrcodetimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
