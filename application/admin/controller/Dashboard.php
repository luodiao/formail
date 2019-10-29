<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Config;

/**
 * 控制台
 *
 * @icon fa fa-dashboard
 * @remark 用于展示当前系统中的统计数据、统计报表及重要实时数据
 */
class Dashboard extends Backend
{

    public function _initialize()
    {
        parent::_initialize();
        $this->WorkOkMdel = new \app\admin\model\WorkOk;
        $this->Adminmodel = new \app\admin\model\Admin;
        $this->WorkMdel = new \app\admin\model\Work;
    }
    /**
     * 查看
     */
    public function index()
    {
        // echo __('Project 1');exit;
        $seventtime = \fast\Date::unixtime('day', -7);
        $paylist = $createlist = [];
        for ($i = 0; $i < 7; $i++)
        {
            $day = date("Y-m-d", $seventtime + ($i * 86400));
            $createlist[$day] = mt_rand(20, 200);
            $paylist[$day] = mt_rand(1, mt_rand(1, $createlist[$day]));
        }
        $hooks = config('addons.hooks');
        $uploadmode = isset($hooks['upload_config_init']) && $hooks['upload_config_init'] ? implode(',', $hooks['upload_config_init']) : 'local';
        $addonComposerCfg = ROOT_PATH . '/vendor/karsonzhang/fastadmin-addons/composer.json';
        Config::parse($addonComposerCfg, "json", "composer");
        $config = Config::get("composer");
        $addonVersion = isset($config['version']) ? $config['version'] : __('Unknown');

        $gq_time = time() - (30*86400);
        $gq_condition = array(
            'status' => 3,
            'end_time' => array('elt',$gq_time)
            );
        //查询过期列表
        $list = $this->WorkOkMdel->where($gq_condition)->order('end_time asc')
                ->select();
        //当前时间戳
        $today = strtotime(date("Y-m-d"));
        $gq = $this->WorkOkMdel->where($gq_condition)->count();
        foreach ($list as $key => &$value) {
            $value->gq_len = ceil(($today - $value->end_time)/86400);
        }

        //获取总付费人数
        unset($gq_condition['end_time']);
        $count_ff = $this->WorkOkMdel->where($gq_condition)->count();
        $count_je = $this->WorkOkMdel->where($gq_condition)->sum('price');
        $count_wwc = $this->WorkMdel->count();

        $m = strtotime(date('Y-m-01', strtotime(date("Y-m-d"))));
        $zq_condition = array();
        $zq_condition['open_time'] = array('egt',$m);
        $zq_condition['status'] = 3;
        $zq_count_ff = $this->WorkOkMdel->where($zq_condition)->count();
        unset($zq_condition['open_time']);
        $zq_condition = array();
        $zq_condition['createtime'] = array('egt',$m);
        $zq_count_wwc = $this->WorkMdel->where($zq_condition)->count();

        $zq_count_cy = $zq_count_ff + $zq_count_wwc;
        $bfb = 0;
        if($zq_count_ff>0){
                $bfb = intval($zq_count_ff / $zq_count_cy *10000) / 100;
            }
        $this->view->assign([
            'list' => $list,
            'gq'   => $gq,
            'count_ff' => $count_ff,
            'count_wwc' => $count_wwc,
            'zq_count_wwc' => $zq_count_wwc,
            'zq_count_ff' => $zq_count_ff,
            'count_cy' => $count_ff + $count_wwc,
            'zq_count_cy' => $zq_count_cy,
            'count_je' => $count_je,
            'bfb' =>$bfb,
            'm' => date("Y-m-d",$m)
        ]);

        return $this->view->fetch();
    }

    public function getgd(){
        $m = strtotime(date('Y-m-01', strtotime(date("Y-m-d"))));
        if(!isset($_POST['s']) || $_POST['s'] == '' || !isset($_POST['e']) || $_POST['e'] == ''){
            $this->error('开始和结束时间必须要选择才能查询');exit;
        }
        $start_time = strtotime($_POST['s']);
        $end_time = strtotime($_POST['e']." 23:59:59");

     
        $zq_count_ff = $this->WorkOkMdel->where('status',3)->where('open_time','>=',$start_time)->where('open_time','<',$end_time)->count();

        $zq_count_wwc = $this->WorkMdel->where('createtime','>=',$start_time)->where('createtime','<',$end_time)->count();
        $zq_count_cy = $zq_count_ff + $zq_count_wwc;
        $bfb = 0;
        if($zq_count_ff>0){
            $bfb = intval($zq_count_ff / $zq_count_cy *10000) / 100;
        }
        $resdata = array(
            'zq_count_ff' => $zq_count_ff,
            'zq_count_wwc' => $zq_count_wwc,
            'zq_count_cy' =>$zq_count_cy,
            'bfb' => $bfb
        );
        $this->success($resdata);
    }
}
