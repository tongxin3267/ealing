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
use think\Route;

Route::group('admin', function(){
    //主体框架后台路由
    Route::group('v1', function(){
        Route::put('bootstrappers', function(){
            return '更新启动信息';
        });
    });
    
    //默认API地址  与版本无关
    Route::miss('Error/index');    
});
