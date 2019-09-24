<?php

namespace app\admin\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\Exception;

use think\Config;

use myvbot;
use think\console\input\Argument;
class Vbot extends Command
{
    //相关机器人配置
    private $config;

    protected function configure()
    {
        $this->setName('Vbot')->setDescription("计划任务 Vbot");
        $this->config = Config::get('vbotconfig');
        $this->model = new \app\admin\model\NewKeyword;
        $this->usermodel = new \app\admin\model\NewWechatUser;
        $this->addArgument('session', Argument::REQUIRED, "The name of the class");
        $this->addArgument('port', Argument::REQUIRED, "The name of the class");
    }

    protected function execute(Input $input, Output $output)
    {
        $userid = $input->getArgument('session');
        $port = $input->getArgument('port');
        $this->config['session'] = "vbot_".$userid."_".$port;
        $this->config['swoole']['port'] = $port;
        $output->writeln('Date Crontab job start...');
        vendor('vbot.Puppet');
        $Puppet = new \Puppet($this->config);
        $Puppet->messageHandler->setHandler(function ($message) use ($Puppet){
            //添加好友
            if ($message['type'] === 'request_friend') {
                // 同意添加好友
                $friends = vbot('friends');
                $friends->approve($message);
                return;
            }
            //
            if($message['type'] !== 'text'){
                return;
            }
            //裂变支持
            // if ($message['type'] === 'group_change') {
            //     $Puppet->sendtext($message['from']['UserName'], 
            //       '欢迎新人 '.$message['invited'].PHP_EOL.'邀请人：'.$message['inviter']);
            //       return;
            // }

            $groups = vbot('groups');

            if($message['fromType'] == 'Self'){
                //自己的消息直接过滤掉
                return;
            }elseif ($message['fromType'] == 'Group') {
                #是群消息
                // if($message['message'] == '群主我不爱你了'){
                //     $groupsList = $groups->getGroupsByNickname('雕雕测试群', $blur = false);
                //     $groups->deleteMember($groupsList['UserName'], $message['username']);
                //     $Puppet->sendtext($message['from']['UserName'], 
                //   '欢迎新人 ');
                //   return;
                //     // Hanson\Vbot\Message\Text::send($message['from']['UserName'], "不爱我了吗，我还是想留住你，挽留这段感情[调皮]\n...");
                // }
            }

            
            //判断是否是群消息
            // if($message['message'] == '我要加群' && $message['fromType'] != 'Group'){
            //     // $members = 
            //     $groupsList = $groups->getGroupsByNickname('雕雕测试群', $blur = false);
            //     $Puppet->sendtext($message['from']['UserName'], "你好啊，小弟正在为您办理进群手续\n 请耐心等待...");
            //     if(empty($groupsList)){
            //         $username[] = $message['from'];
            //         $username[] = $message['from'];
            //         $group = $groups->create($username);

            //         $groups->setGroupName($group['UserName'],"雕雕测试群");
            //     }else{
            //         $groups->addMember($groupsList['UserName'], $message['username']);
            //     }
                
            //     sleep(2);
            //     $Puppet->sendimages($groupsList['UserName'],'/Users/luodiao/Downloads/4b0976c6a7efce1b415b31f5a451f3deb58f6580.jpg');
            // }
            
            if($message['fromType'] == 'Group'){
                // 查询单个数据
                $key_arr = array("商城","涨粉","裂变","任务宝","迁移");
                $status_key = false;
                foreach ($key_arr as $key => $value) {
                    if(strpos($message['message'],$value) !== false){ 
                         $status_key = true;
                         break;
                    }
                }

                $key_arr_editor = array("课程","写作","文案");
                $status_key_for_editor = false;
                foreach ($key_arr_editor as $key => $value) {
                    if(strpos($message['message'],$value) !== false){ 
                         $status_key_for_editor = true;
                         break;
                    }
                }
                // $list = $this->model->where('key', $message['message'])->find();
                // if(!$list){
                //     return;
                //     //如果不存在，查询全部数据进行筛选
                //     $list_select = $this->model
                //             ->order('weigh', 'desc')
                //             ->select();
                //     foreach ($list_select as $key => $value) {
                //         if(strpos($message['message'],$value->key) !==false){
                //             $list = $value;
                //             break;
                //         }
                //     }
                //     if(!$list){
                //         return;
                //     }
                // }
                // switch ($list->type) {
                //     case '0':
                //         // usleep(500000);
                //         // $Puppet->sendtext($message['from']['UserName'],$list->desc);
                //         break;
                //     case '1':
                //         // usleep(800000);
                //         // $Puppet->sendimages($message['from']['UserName'],'/Users/luodiao/Downloads/4b0976c6a7efce1b415b31f5a451f3deb58f6580.jpg');
                //         // $Puppet->sendimages($message['from']['UserName'],ROOT_PATH."public/".$list->image);
                //         break;
                    
                //     default:
                //         # code...
                //         break;
                // }
                if($status_key){
                    $groupsList = $groups->getGroupsByNickname('运营指南通知群', $blur = false);
                    $Puppet->sendtext($groupsList['UserName'],"新消息提示！\n时间：".date('Y-m-d H:i:s',time())."\n用户所在微信群：【".$message['from']['NickName']."】\n用户名称：【".$message['sender']['NickName']."】\n用户说：【".$message['message']."】");
                }

                if($status_key_for_editor){
                    $groupsList_editor = $groups->getGroupsByNickname('编辑器通知群', $blur = false);
                    $Puppet->sendtext($groupsList_editor['UserName'],"新消息提示！\n时间：".date('Y-m-d H:i:s',time())."\n用户所在微信群：【".$message['from']['NickName']."】\n用户名称：【".$message['sender']['NickName']."】\n用户说：【".$message['message']."】");
                }
            }
            
            // Hanson\Vbot\Message\Text::send($message['from']['UserName'], '你好啊，我在测试消息');
        });
    
        //重新写入二维码
        $Puppet->observer->setQrCodeObserver(function($qrCodeUrl) use ($Puppet,$userid,$port){
            //重新写入用户uuid
            // $data = array(
            //     "uuid" => $Puppet->config['server.uuid'],
            //     "user_id" => $userid,
            //     "port" => $port,
            //     );
            $vbotUserObj = $this->usermodel->where('user_id',$userid)->where('port',$port)->find();
            if(!$vbotUserObj){
                exit("未能找到启动脚本");
            }
            $vbotUserObj->status = 1;
            $vbotUserObj->qrcodetime = time();
            $vbotUserObj->uuid = $Puppet->config['server.uuid'];
            $vbotUserObj->save();
        });
        
        //登录成功 --> 记录用户信息
        $Puppet->observer->setLoginSuccessObserver(function() use ($Puppet,$userid,$port){
            $vbotUserObj = $this->usermodel->where('user_id',$userid)->where('port',$port)->find();
            if(!$vbotUserObj){
                exit("未能找到启动脚本1");
            }
            if($Puppet->myself->uin == '' || !isset($Puppet->myself->uin) || strlen($Puppet->myself->uin) < 4 || $Puppet->myself->username == '' || !isset($Puppet->myself->username) || strlen($Puppet->myself->username) < 4){
                $vbotUserObj->status = 3;
                $vbotUserObj->save();
                exit;
            }else{
                $vbotUserObj->status = 2;
                $vbotUserObj->nickname = $Puppet->myself->nickname;
                $vbotUserObj->username = $Puppet->myself->username;
                $vbotUserObj->uin = $Puppet->myself->uin;
                $vbotUserObj->save();
            }
        });

        $Puppet->observer->setExitObserver(function()use ($userid,$port){
            $vbotUsersObj = $this->usermodel->where('user_id',$userid)->where('port',$port)->find();
            if(!$vbotUsersObj){
                exit("未能找到启动脚本2");
            }
            $vbotUsersObj->status = 3;
            if($vbotUsersObj->save()){
                echo "成功";
            }else{
                echo "失败";
            }
            echo "退出登录111\n";

        });
        $Puppet->server->serve();
        $output->info("Build Successed!");
    }
}
