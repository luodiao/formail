<?php

namespace app\admin\model;

use think\Model;
use \app\admin\model\WxEs;
use \app\admin\model\YyznUsers;
use \app\admin\model\yyznCarts;

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
    protected $YyznUsers = false;
    protected $WxEs = false;
    protected $yyznCarts = false;

    // 追加属性
    protected $append = [
        'pay_type_text',
        'aid_text',
        'num_text',
        'wechat_name',
        'admin_text',
        'user_name',
        'code_text',
    ];
    public function __initialize()
    {
        parent::_initialize();
        $this->YyznUsers = new YyznUsers();
        $this->WxEs = new WxEs();
        $this->yyznCarts = new yyznCarts();
    }

    public function getUserName($user_id){
        return $this->YyznUsers->where('id',$user_id)->value('username');
    }
    public function getWxName($wx_id){
        $name = $this->WxEs->where('id',$wx_id)->value('name');
        if($name){
            return $name;
        }
        return '';
    }
    //获取公众号名称
    public function getCodeTextAttr($value,$data){
        $order_id = isset($data['fk_id']) ? $data['fk_id'] : '';
        $is_code = isset($data['is_code']) ? $data['is_code'] : '';
        if($is_code > 0){
            return $this->yyznCarts->where('product_model','WxActivitiesAuth_Dis')->where('order_id',$order_id)->value('remarks');
        }
        return null;
    }

    //获取公众号名称
    public function getAdminTextAttr($value,$data){
        $value = $value ? $value : (isset($data['admin_id']) ? $data['admin_id'] : '');
        if($value > 0){
            return $this->getUserName($value);
        }
        return null;
    }
    public function getUserNameAttr($value,$data){
        $value = $value ? $value : (isset($data['user_id']) ? $data['user_id'] : '');
        if($value > 0){
            return $this->getUserName($value);
        }
        return null;
    }
    //获取公众号名称
    public function getWechatNameAttr($value,$data){
        $value = $value ? $value : (isset($data['wx_id']) ? $data['wx_id'] : '');
        if($value > 0){
            return $this->getWxName($value);
        }
        return '';
    }

    public function getPayTypeList()
    {
        return ['0' => __('Pay_type 0'),'1' => __('Pay_type 1'), '2' => __('Pay_type 2'), '3' => __('Pay_type 3'), '4' => __('Pay_type 4')];
    }


    public function getPayTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['pay_type']) ? $data['pay_type'] : '');
        $list = $this->getPayTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    //获取应用名称
    public function getAidList()
    {
        return ['1' => __('A_tite 1'), '2' => __('A_tite 2'), '3' => __('A_tite 3')];
    }

    public function getAidTextAttr($value,$data){
        $value = $value ? $value : (isset($data['aid']) ? $data['aid'] : '');
        $list = $this->getAidList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getNumTextAttr($value,$data){
        $value = $value ? $value : (isset($data['num']) ? $data['num'] : '0');
        if($data['pay_type'] == 3){
            return $value.'天';
        }
        return $value.'月';
    }


}
