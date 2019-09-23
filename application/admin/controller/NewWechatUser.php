<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class NewWechatUser extends Backend
{
    
    /**
     * NewWechatUser模型对象
     * @var \app\admin\model\NewWechatUser
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\NewWechatUser;
        $this->portmodel = new \app\admin\model\NewWechatPort;

        $this->view->assign("statusList", $this->model->getStatusList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */

    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                if(!isset($params['token']) || $params['token'] == ''){
                    $this->error("token不能为空,请仔细填写token");
                }else{
                    $portObj = $this->portmodel->where('token', $params['token'])->where('status',0)->where('user_id',$this->auth->id)->find();
                    if(!$portObj){
                        $this->error("token有误，或者已经被使用");
                    }
                    $params['port'] = $portObj->port;
                    $params['user_id'] = $portObj->user_id;
                }
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : $name) : $this->modelValidate;
                        $this->model->validateFailException(true)->validate($validate);
                    }
                    $result = $this->model->allowField(true)->save($params);
                    $portObj->status = 1;
                    $portObj->save();
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $cmd = "cd ".ROOT_PATH." && ./vbot.sh ".ROOT_PATH." ".$params['user_id']." ".$params['port'];
                     system($cmd,$retval);

                    $this->success();
                } else {
                    $this->error(__('No rows were inserted'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
    //查看脚本状态
    public function checkeservice(){
        if ($this->request->isPost()) {
            $id = $_POST['id'];
            $list = $this->model->where('id',$id)->find();
            if(!$list){
                $this->error(__('信息不存在'));
            }
            switch ($list->status) {
                case '0':
                    $res = array(
                        'code' => 201,
                        'data' => "程序没有执行",
                    );
                    break;
                case '1':
                    
                    $savePath = APP_PATH . '/../public/qrcode/';
                    $webPath = '/qrcode/';
                    $qrData = 'https://login.weixin.qq.com/l/'.$list->uuid;
                    $qrLevel = 
                    $qrSize = '8';
                    $savePrefix = 'NickBai';
                    if($filename = createQRcode($savePath, $qrData, $qrLevel, $qrSize, $savePrefix)){
                        $pic = $webPath . $filename;
                    }

                    $res = array(
                        'code' => 200,
                        'data' => "<img src='".$pic."'>",
                    );
                    break;
                case '2':
                    $res = array(
                        'code' => 201,
                        'data' => "成功登陆",
                    );
                    break;
                case '3':
                    $res = array(
                        'code' => 201,
                        'data' => "订单已经终止",
                    );
                    break;
                
                default:
                    $res = array(
                        'code' => 200,
                        'data' => "未知错误",
                    );
                    break;
            }
            echo json_encode($res);
        }else{
            $id = $_GET['id'];
            $this->assign('id',$id);
            return $this->view->fetch();
        }
    }
    //重新开启
    public function revbox(){
        $id = $_POST['id'];
        $list = $this->model->where('id',$id)->find();
        if(!$list){
            $this->error(__('信息不存在'));
        }
        if($list->status != 3){
            $this->error(__('订单不为终止状态'));
        }
        $list->status = 0;
        $list->save();
        $cmd = "cd ".ROOT_PATH." && ./vbot.sh ".ROOT_PATH." ".$list->user_id." ".$list->port;
         system($cmd,$retval);
        $this->success();
    }

    public function runwechat(){
        $cmd = "cd /web/formail/ && ./vbot.sh /web/formail/ 1 7536";
        system($cmd,$retval);
        echo 11111;exit;
    }
    //开启机器人

    // public function add(){

    //     $port = rand(1024,32767); 
    //     $session = $this->auth->id;
    //     $cmd = "nohup cd ".ROOT_PATH." &&  php think Vbot ".$session." ".$port." &";
    //     system($cmd,$retval);
    //     //输出 二维码
    // }

}
