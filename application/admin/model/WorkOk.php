<?php

namespace app\admin\model;

use think\Model;


class WorkOk extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'work_ok';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'wechat_type_text',
        'industry_type_text',
        'project_text',
        'open_time_text',
        'end_time_text',
        'status_text'
    ];
    

    
    public function getWechatTypeList()
    {
        return ['1' => __('Wechat_type 1'), '2' => __('Wechat_type 2'), '3' => __('Wechat_type 3')];
    }

    public function getIndustryTypeList()
    {
        return ['1' => __('Industry_type 1'), '2' => __('Industry_type 2')];
    }

    public function getProjectList()
    {
        return ['1' => __('Project 1'), '2' => __('Project 2'), '3' => __('Project 3'), '98' => __('Project 98'), '99' => __('Project 99')];
    }

    public function getStatusList()
    {
        return ['1' => __('Status 1'), '2' => __('Status 2'), '3' => __('Status 3')];
    }


    public function getWechatTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['wechat_type']) ? $data['wechat_type'] : '');
        $list = $this->getWechatTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIndustryTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['industry_type']) ? $data['industry_type'] : '');
        $list = $this->getIndustryTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getProjectTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['project']) ? $data['project'] : '');
        $list = $this->getProjectList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getOpenTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['open_time']) ? $data['open_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getEndTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['end_time']) ? $data['end_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    protected function setOpenTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setEndTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
