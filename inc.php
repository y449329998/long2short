<?php
$config=[
    //数据库
    'db'=>[
        'database_type' => 'mysql', //数据库类型mysql
        'database_name' => 'shorturl',//数据库名
        'server' => '127.0.0.1',//数据库地址
        'username' => 'root',//数据库用户名
        'password' => 'root',//数据库密码
        'charset'=>'utf8',//编码
        'prefix'=>'short_'//前缀
    ],
    //获取token的微信公众号
    'wechat'=>[
        'appid'=>'wx092572556238',//微信公众号appid
        'secret'=>'fsdfgsdggfgfgsg',//微信公众号密钥
    ],
   
];

define('CONF', $config);

