<?php

use Medoo\Medoo;

function jsonReturn($data)
{
    header('Content-Type:application/json');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

function getShortUrl($longUrl)
{
    $db = new Medoo(CONF['db']);
    $url = $db->get('url', '*', ['url' => $longUrl]);
    if ($url) {
        $returnData = array(
            'res' => true,
            "short_url" => $url['short']
        );
        return $returnData;
    } else {
        $short = '';
        $i = 0;
        while (!$short) {
            $short = long2short($longUrl);
            $i++;
            if ($i > 3) break;
        }

        if ($short['res']) {
            $data = [
                'url' => $longUrl,
                'short' => $short["short_url"],
                'createtime' => time()
            ];
            $db->insert('url', $data);

            $returnData = array(
                'res' => true,
                "short_url" => $short["short_url"],
            );
            return $returnData;

        } else {
            $returnData = array(
                'res' => false,
                "errmsg" => $short["errmsg"],
            );
            return $returnData;
        }
    }

}


function getToken()
{
    $file = __DIR__ . DIRECTORY_SEPARATOR . 'token.json';
    $data = file_get_contents($file);
    $data = json_decode($data, true);
    if ($data && (time() - $data['update']) < 600) {
        return $data['access_token'];
    } else {
        $wechat = CONF['wechat'];
        $appid = $wechat['appid'];

        $secret = $wechat['secret'];

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $secret;
        $data = request($url);

        $data = json_decode($data, true);//进行json解码
        //存到本地
        $data['update'] = time();
        file_put_contents($file, json_encode($data));

        return $data['access_token'];
    }
}


function long2short($long_url)
{
    $access_token = getToken();
    $url = 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token=' . $access_token;
    $data['action'] = 'long2short';
    $data['long_url'] = $long_url;
    $data_json = json_encode($data);

    $resData = request($url, true, 'post', $data_json);

    $res = json_decode($resData, true);//数组格式
    //        array(3) {
    //                ["errcode"] => int(0)
    //                ["errmsg"] => string(2) "ok"
    //                ["short_url"] => string(26) "https://w.url.cn/s/AluV6Vh"
    //        }

    // var_dump($res);exit;
    if ($res['errcode'] == 0 && $res['errmsg'] == 'ok') {
        $res['res'] = true;
    } else {
        $res['res'] = false;
    }

    return $res;

}

function request($curl, $https = true, $method = 'get', $data = null, $headers = false)
{

    $ch = curl_init();//初始化
    curl_setopt($ch, CURLOPT_URL, $curl);//设置访问的URL
    if ($headers) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);//设置需要头信
    } else {
        curl_setopt($ch, CURLOPT_HEADER, $headers);//设置不需要头信息
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//只获取页面内容，但不输出
    if ($https) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//不做服务器认证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//不做客户端认证
    }
    if ($method == 'post') {
        curl_setopt($ch, CURLOPT_POST, true);//设置请求是POST方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置POST请求的数据
    }
    $str = curl_exec($ch);//执行访问，返回结果
    curl_close($ch);//关闭curl，释放资源
    return $str;
}

function getTime()
{
    return date('Y-m-d H:i:s');
}

