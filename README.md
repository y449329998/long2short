# long2short
一个轻量的可以生成微信短链接的接口程序

### 1.克隆项目到本地
```
git clone https://github.com/y449329998/long2short.git
```
### 2.用 `short_url.sql` 文件导入数据结构

### 3.配置 inc.php 文件
```
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
```
### 4.网站根目录设置为public目录

### 5.生产短链
#### 5.1 get请求
```
http://localhost/?url=http://www.baidu.com
```

#### 5.2 得到数据
```
{
    "error": 0,   //0,成功,1失败,2 缺少url参数
    "short_url": "https://w.url.cn/s/AAAskQk", //生产的短链
    "msg":"生产短链失败" //当error不为0是返回改字段
}
```
