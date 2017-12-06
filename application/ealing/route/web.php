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


//主体框架V1版接口
Route::group('api', function(){
    Route::group('v1' , function(){
        Route::get('token','ealing/v1.Token/getToken');//初始授权地址
        Route::get('bootstrappers', 'ealing/v1.Bootstrappers/read');//启动信息
        Route::get('user/fans', function(){
            return 'v1版用户粉丝';
        });
        
        //验证码相关
        Route::group('verifycodes', function(){
            Route::post('register', 'ealing/v1.VerifyCode/save');//注册验证码
            Route::get('/', 'ealing/v1.VerifyCode/read');//已存在用户验证码
        });
    });
    
    //主体框架V2版接口
    Route::group('v2', function(){
        Route::get('user/fans', function(){
            return 'v2版用户粉丝';
        });
    });
    
    //默认API地址  与版本无关
    Route::miss('Error/index');
});
