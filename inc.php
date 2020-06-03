<?php
$config=[
    //书籍数据库
    'db'=>[
        'database_type' => 'mysql',
        'database_name' => 'shorturl',
        'server' => '106.12.49.126',
        'username' => 'root',
        'password' => 'root',
        'charset'=>'utf8',
        'prefix'=>'short_'
    ],
    //获取token的微信公众号
    'wechat'=>[
        'appid'=>'wx092572556238',
        'secret'=>'fsdfgsdggfgfgsg',
    ],
   
];

define('CONF', $config);

