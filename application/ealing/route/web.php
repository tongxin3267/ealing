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
        Route::get('token','ealing/v1.Token/store');//初始授权地址
        Route::patch('tokens/:token', 'ealing/v1.Token/refresh');//刷新token
        
        Route::get('bootstrappers', 'ealing/v1.Bootstrappers/show');//启动信息
        
        Route::get('locations/search', 'ealing/v1.Location/search');//搜索位置
        
        Route::get('locations/hots', 'ealing/v1.Location/hots');//热门位置
        
        Route::get('advertisingspace', 'ealing/v1.Advertising/index');//获得广告空间
        Route::get('advertisingspace/:space/advertising', 'ealing/v1.Advertising/advertising');//获取指定空间的广告数据
        Route::get('advertisingspace/advertising', 'ealing/v1.Advertising/batch');//获取所有广告数据
        
        Route::get('aboutus', 'ealing/v1.System/about');//关于我们数据  html
        
        Route::get('tags', 'ealing/v1.Tag/index');//获取所有标签
        
        //验证码相关
        Route::group('verifycodes', function(){
            Route::post('register', 'ealing/v1.VerifyCode/save');//注册验证码
            Route::get('/', 'ealing/v1.VerifyCode/read');//已存在用户验证码
        });
        
        //排行榜相关
        Route::group('ranks', function(){
            Route::get('followers', 'ealing/v1.Rank/followers');//获取粉丝排行
            Route::get('balance', 'ealing/v1.Rank/balance');//获取财富排行
            Route::get('income', 'ealing/v1.Rank/income');//获取收入排行
        });
        
        Route::get('files/:fileWith', 'ealing/v1.Files/show');//获取文件
        
        /*
         |-----------------------------------------------------------------------
         | 与公开用户相关
         |-----------------------------------------------------------------------
         |
         | 定于公开用户的相关信息路由
         |
         */
        Route::group('user', function(){
            Route::post('find-by-phone', 'ealing/v1.FindUser/findByPhone');//通过手机号查找
            Route::get('populars', 'ealing/v1.FindUser/populars');//热门用户, 根据粉丝数量倒序排列
            Route::get('latests', 'ealing/v1.FindUser/latests');//最新用户,按注册时间倒序
            Route::get('recommends', 'ealing/v1.FindUser/recommends');//推荐用户
            Route::get('search', 'ealing/v1.FindUser/search');//搜索用户
            Route::get('find-by-tags', 'ealing/v1.FindUser/findByTags');//通过标签推荐用户
        });
        
        Route::group('users', function(){
            Route::post('/', 'ealing/v1.User/store');//创建一个用户
            Route::get('/', 'ealing/v1.User/index');//批量获取用户
            Route::get('/:user', 'ealing/v1.User/show');//获取单个用户
            Route::get('/:user/avatar', 'ealing/v1.UserAvatar/show');//获取用户头像
            Route::get('/:user/followers', 'ealing/v1.UserFollow/followers');//获取用户关注者
            Route::get('/:user/followings', 'ealing/v1.UserFollow/followings');//获取用户关注的用户
            Route::get('/:user/tags', 'ealing/v1.TagUser/userTgas');//获取用户标签
        });
        
        Route::put('user/retrieve-password', 'ealing/v1.ResetPassword/retrieve');//检索用户密码
        
        /*
        | -----------------------------------------------------------------------
        |定义一个路径，需要用户身份验证。
        | -----------------------------------------------------------------------
        |
        |这里定义的路由路径，需要用户
        |认证访问。
        |
        */
        Route::group('auth', function(){
            /*
            | --------------------------------------------------------------------
            |定义当前认证用户操作路径。
            | --------------------------------------------------------------------
            |
            |定义当前已通过身份验证的用户相关联的路线，
            |如获取当前用户，更新用户数据，等等。
            |
            */            
            Route::group('user', function(){
                
            });
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
