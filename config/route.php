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
    
    
    
    
});