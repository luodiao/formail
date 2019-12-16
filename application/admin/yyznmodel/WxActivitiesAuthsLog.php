<?php

namespace app\admin\model;

use think\Model;


class WxActivitiesAuthsLog extends Model
{

    

    //数据库
    protected $connection = 'yyzn';
    // 表名
    protected $name = 'wx_activities_auths_log';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'pay_type_text'
    ];
    

    
    public function getPayTypeList()
    {
        return ['0' => '其他', '1' => '支付宝支付', '2' => '微信支付', '3' => '兑换码','4' => '增加时间'];
    }


    public function getPayTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['pay_type']) ? $data['pay_type'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }



}
