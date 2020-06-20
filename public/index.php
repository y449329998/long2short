<?php
ini_set('date.timezone', 'Asia/Shanghai');
require_once '../vendor/autoload.php';
require_once '../inc.php';
require_once '../func.php';

//获取短连接
$longUrl = $_GET['url'];
//$longUrl = 'http://m.789aread.com?hhs=huuiuii';
if ($longUrl) {
    $shortUrl = getShortUrl($longUrl);
    if ($shortUrl['res']) {
        $data = [
            'error' => 0,
            'short_url' => $shortUrl['short_url'],
        ];
    } else {
        $data = [
            'error' => 1,
            'msg' => '生产短链失败!'.$shortUrl['errmsg']
        ];
    }
    jsonReturn($data);
} else {
    $data = [
        'error' => 2,
        'msg' => '没有url参数!'
    ];
    jsonReturn($data);
}
