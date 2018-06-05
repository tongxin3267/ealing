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
use app\ealing\controller\v1 as API1;

//主体框架V1版接口
Route::group('ealing', function(){
    Route::group('v1' , function(){
        Route::get('token', API1\Token::class.'@store');//初始授权地址
        Route::patch('tokens/refresh', API1\Token::class.'@refresh');//刷新token
        
        Route::get('bootstrappers', API1\Bootstrappers::class.'@show');//启动信息

        Route::get('advertisingspace/:space/advertising', API1\Advertising::class.'@advertising');//获取指定空间的广告数据
        Route::get('advertisingspace/advertising', API1\Advertising::class.'@batch');//批量获取广告列表
        Route::get('advertisingspace', API1\Advertising::class.'@index');//获得广告空间
        
        Route::get('aboutus', API1\System::class.'@about');//关于我们数据  html
    });
});
