<?php

namespace app\admin\yyznmodel;
//链接运营指南
use think\Model;
use think\Session;

class Yyzn extends Model
{
    protected $connection = [
        // 数据库类型
        'type'        => 'mysql',
        // 数据库连接DSN配置
        'dsn'         => '',
        // 服务器地址
        'hostname'    => '10.66.113.227',
        // 数据库名
        'database'    => 'yyzn',
        // 数据库用户名
        'username'    => 'yyzn',
        // 数据库密码
        'password'    => 'SnvfadsyPI_Tkh9TrAds',
        // 数据库连接端口
        'hostport'    => '3306',
        // 数据库连接参数
        'params'      => [],
        // 数据库编码默认采用utf8
        'charset'     => 'utf8',
        // 数据库表前缀
        'prefix'      => 'miao_',
    ];
}
