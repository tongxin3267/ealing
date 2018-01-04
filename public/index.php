<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 实现前后端完全分类所遇到的跨域问题
if ($_SERVER['REQUEST_METHOD']=='OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
    header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
    return;
}

header('content-type:text/html;charset=utf-8');
header('Access-Control-Allow-Origin: http://localhost:8081');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
  
// 定义配置文件目录和应用目录同级
define('CONF_PATH', __DIR__.'/../config/');

// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';
