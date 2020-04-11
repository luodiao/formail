<?php

namespace app\admin\model;

use think\Model;


class Authinfolog extends Model
{

    

    //数据库
    protected $connection = 'database';
    // 表名
    protected $name = 'authinfolog';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'auth_text',
        'type_text',
        'level_text'
    ];
    

    
    public function getAuthList()
    {
        return ['1' => __('Auth 1'), '2' => __('Auth 2'), '3' => __('Auth 3'), '4' => __('Auth 4'), '5' => __('Auth 5')];
    }

    public function getTypeList()
    {
        return ['0' => __('Type 0'), '1' => __('Type 1'), '2' => __('Type 2'), '3' => __('Type 3'), '4' => __('Type 4')];
    }

    public function getLevelList()
    {
        return ['0' => __('Level 0'), '1' => __('Level 1'), '2' => __('Level 2'), '3' => __('Level 3')];
    }


    public function getAuthTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['auth']) ? $data['auth'] : '');
        $list = $this->getAuthList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['type']) ? $data['type'] : '');
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getLevelTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['level']) ? $data['level'] : '');
        $list = $this->getLevelList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
