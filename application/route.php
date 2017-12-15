<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
/**
* 载入所有模块的路由(包括主体路由)
* @date: 2017年11月24日 下午5:49:50
* @author: onep2p <324834500@qq.com>
* @param: $GLOBALS
* @return:
*/
$apps = scandir(APP_PATH);
foreach ($apps as $app){
    if('.' == $app || '..' == $app) continue;
    
    //载入前端所有路由
    if(is_dir(APP_PATH . $app) && is_readable(APP_PATH . $app . '/route/web.php') == true) {
        include_once APP_PATH . $app . '/route/web.php';
    }
    
    //载入后端所有路由
    if(is_dir(APP_PATH . $app) && is_readable(APP_PATH . $app . '/route/admin.php') == true) {
        include_once APP_PATH . $app . '/route/admin.php';
    }
}