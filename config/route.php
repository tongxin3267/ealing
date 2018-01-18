<?php

use think\Route;

Route::group('api', function(){
    $apps = scandir(APP_PATH);
    foreach ($apps as $app){
        if('.' == $app || '..' == $app) continue;
    
        //载入前端所有路由
        if(is_dir(APP_PATH . $app) && is_readable(APP_PATH . $app . '/route/api' . EXT) == true) {
            include '../application/' . $app . '/route/api' . EXT;
        }
    }
});

Route::group('admin', function(){
    $apps = scandir(APP_PATH);
    foreach ($apps as $app){
        if('.' == $app || '..' == $app) continue;
    
        //载入前端所有路由
        if(is_dir(APP_PATH . $app) && is_readable(APP_PATH . $app . '/route/admin' . EXT) == true) {
            include '../application/' . $app . '/route/admin' . EXT;
        }
    }
});
    
//默认API地址  与版本无关
Route::miss('Error/index');