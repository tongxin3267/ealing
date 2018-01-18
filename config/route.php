<?php

use think\Route;

Route::group('api', function(){
    $apps = scandir(APP_PATH);
    foreach ($apps as $app){
        if('.' == $app || '..' == $app) continue;
    
        //载入前端所有路由
        if(is_dir(APP_PATH . $app) && is_readable(APP_PATH . $app . '/route/route.php') == true) {
            include '../application/' . $app . '/route/route' . EXT;
        }
    }
    
    
    
    //如果路径不好看，可以把前端和后端的分开     前端模式为api/模块名/版本号/地址    后端模式为admin/模块名/版本号/地址    当前感觉没必要，后期再说
});
    
//默认API地址  与版本无关
Route::miss('Error/index');