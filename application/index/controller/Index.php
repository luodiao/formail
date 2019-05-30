<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Token;
use app\index\model\NewBanner;
use think\Url;
class Index extends Frontend
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $layout = '';

    public function index()
    {
        $NewBanner = new NewBanner();
        $list = $NewBanner->where(['status'=>1])->select();
        $this->assign('title',"首页");
        $this->assign('list',$list);

        return $this->fetch();
    }

    public function news()
    {
        $newslist = [];
        return jsonp(['newslist' => $newslist, 'new' => count($newslist), 'url' => 'https://www.fastadmin.net?ref=news']);
    }

}
