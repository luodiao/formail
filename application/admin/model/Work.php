<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Work extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'work';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    use SoftDelete;
    protected $deleteTime = 'deletetime';

    // 追加属性
    protected $append = [
        'wechat_type_text',
        'industry_type_text',
        'project_text',
        'level_text',
        'frist_time_text',
        'callback_time_text'
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

    public function getLevelList()
    {
        return ['5' => __('Level 5'), '4' => __('Level 4'), '3' => __('Level 3'), '2' => __('Level 2'), '1' => __('Level 1')];
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


    public function getLevelTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['level']) ? $data['level'] : '');
        $list = $this->getLevelList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getFristTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['frist_time']) ? $data['frist_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getCallbackTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['callback_time']) ? $data['callback_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setFristTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setCallbackTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
