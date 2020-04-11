<?php

namespace app\admin\model;

use think\Model;
use \app\admin\model\WxEs;
use \app\admin\model\YyznUsers;

class WxActivitiesAuthsInfo extends Model
{
    //数据库
    protected $connection = 'yyzn';
    // 表名
    protected $name = 'wx_activities_authinfos';
     public function __construct($data = [])
    {
        parent::__construct($data);
        $this->YyznUsers = new YyznUsers();
        $this->WxEs = new WxEs();
        
    }
    // 追加属性
    protected $append = [
        'wechat_name',
        'user_name',
        'auth_text',
    ];

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
    public function getUserNameAttr($value,$data){
        $value = $value ? $value : (isset($data['fk_user_id']) ? $data['fk_user_id'] : '');
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

    public function getAidList()
    {
        return ['1' => __('A_tite 1'), '2' => __('A_tite 2'), '3' => __('A_tite 3'),'4' => __('A_tite 4'),'5' => __('A_tite 5'),'6' => __('A_tite 6')];
    }

    public function getAuthTextAttr($value,$data){
        $value = $value ? $value : (isset($data['fk_id']) ? $data['fk_id'] : '');
        $list = $this->getAidList();
        return isset($list[$value]) ? $list[$value] : '';
    }
}