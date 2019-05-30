<?php

namespace app\admin\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;
use think\Exception;

use think\Config;

use myvbot;

class Vbot extends Command
{
    //相关机器人配置
    private $config;

    protected function configure()
    {
        $this->setName('Vbot')->setDescription("计划任务 Vbot");
        $this->config = Config::get('vbotconfig');
        $this->model = new \app\admin\model\NewKeyword;

    }

    protected function execute(Input $input, Output $output)
    {
        $output->writeln('Date Crontab job start...');
        var_dump($this->config);
        vendor('vbot.Puppet');
        $Puppet = new \Puppet($this->config);
        $lala1 = 245;
        $Puppet->messageHandler->setHandler(function ($message) use ($Puppet){
            var_dump($message['fromType']);
            var_dump($message['type']);
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
            if ($message['type'] === 'group_change') {
                $Puppet->sendtext($message['from']['UserName'], 
                  '欢迎新人 '.$message['invited'].PHP_EOL.'邀请人：'.$message['inviter']);
                  return;
            }

            $groups = vbot('groups');

            if($message['fromType'] == 'Self'){
                //自己的消息直接过滤掉
                return;
            }elseif ($message['fromType'] == 'Group') {
                #是群消息
                if($message['message'] == '群主我不爱你了'){
                    $groupsList = $groups->getGroupsByNickname('雕雕测试群', $blur = false);
                    $groups->deleteMember($groupsList['UserName'], $message['username']);
                    $Puppet->sendtext($message['from']['UserName'], 
                  '欢迎新人 ');
                  return;
                    // Hanson\Vbot\Message\Text::send($message['from']['UserName'], "不爱我了吗，我还是想留住你，挽留这段感情[调皮]\n...");
                }
            }

            
            //判断是否是群消息
            if($message['message'] == '我要加群' && $message['fromType'] != 'Group'){
                // $members = 
                $groupsList = $groups->getGroupsByNickname('雕雕测试群', $blur = false);
                $Puppet->sendtext($message['from']['UserName'], "你好啊，小弟正在为您办理进群手续\n 请耐心等待...");
                if(empty($groupsList)){
                    $username[] = $message['from'];
                    $username[] = $message['from'];
                    $group = $groups->create($username);

                    $groups->setGroupName($group['UserName'],"雕雕测试群");
                }else{
                    $groups->addMember($groupsList['UserName'], $message['username']);
                }
                
                sleep(2);
                $Puppet->sendimages($groupsList['UserName'],'/Users/luodiao/Downloads/4b0976c6a7efce1b415b31f5a451f3deb58f6580.jpg');
            }
            
            if($message['fromType'] != 'Group'){
                // 查询单个数据
                $list = $this->model->where('key', $message['message'])->find();
                if(!$list){
                    //如果不存在，查询全部数据进行筛选
                    $list_select = $this->model
                            ->order('weigh', 'desc')
                            ->select();
                    foreach ($list_select as $key => $value) {
                        if(strpos($message['message'],$value->key) !==false){
                            $list = $value;
                            break;
                        }
                    }
                    if(!$list){
                        return;
                    }
                }

                switch ($list->type) {
                    case '0':
                        usleep(500000);
                        $Puppet->sendtext($message['from']['UserName'],$list->desc);
                        break;
                    case '1':
                        usleep(800000);
                        // $Puppet->sendimages($message['from']['UserName'],'/Users/luodiao/Downloads/4b0976c6a7efce1b415b31f5a451f3deb58f6580.jpg');
                        $Puppet->sendimages($message['from']['UserName'],ROOT_PATH."public/".$list->image);
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }
            
            // Hanson\Vbot\Message\Text::send($message['from']['UserName'], '你好啊，我在测试消息');
        });

        $Puppet->server->serve();
        $output->info("Build Successed!");
    }
}
