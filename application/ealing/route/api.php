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
        Route::patch('tokens/:token', API1\Token::class.'@refresh');//刷新token
        
        Route::get('bootstrappers', API1\Bootstrappers::class.'@show');//启动信息
        
        Route::get('locations/search', API1\Location::class.'@search');//搜索位置
        
        Route::get('locations/hots', API1\Location::class.'@hots');//热门位置

        Route::get('advertisingspace/:space/advertising', API1\Advertising::class.'@advertising');//获取指定空间的广告数据
        Route::get('advertisingspace/advertising', API1\Advertising::class.'@batch');//批量获取广告列表
        Route::get('advertisingspace', API1\Advertising::class.'@index');//获得广告空间
        
        Route::get('aboutus', API1\System::class.'@about');//关于我们数据  html
        
        Route::get('tags', API1\Tag::class.'@index');//获取所有标签
        
        //验证码相关
        Route::group('verifycodes', function(){
            Route::post('register', API1\VerifyCode::class.'@storeByRegister');//注册验证码
            Route::get('/', API1\VerifyCode::class.'@store');//已存在用户验证码
        });
        
        //排行榜相关
        Route::group('ranks', function(){
            Route::get('followers', API1\Rank::class.'@followers');//获取粉丝排行
            Route::get('balance', API1\Rank::class.'@balance');//获取财富排行
            Route::get('income', API1\Rank::class.'@income');//获取收入排行
        });
        
        Route::get('files/:fileWith', API1\Files::class.'@show');//获取文件
        
        /*
         |-----------------------------------------------------------------------
         | 与公开用户相关
         |-----------------------------------------------------------------------
         |
         | 定于公开用户的相关信息路由
         |
         */
        Route::group('user', function(){
            Route::post('find-by-phone', API1\FindUser::class.'@findByPhone');//通过手机号查找
            Route::get('populars', API1\FindUser::class.'@populars');//热门用户, 根据粉丝数量倒序排列
            Route::get('latests', API1\FindUser::class.'@latests');//最新用户,按注册时间倒序
            Route::get('recommends', API1\FindUser::class.'@recommends');//推荐用户
            Route::get('search', API1\FindUser::class.'@search');//搜索用户
            Route::get('find-by-tags', API1\FindUser::class.'@findByTags');//通过标签推荐用户
        });
        
        Route::group('users', function(){
            Route::post('/', API1\User::class.'@store');//创建一个用户
            Route::get('/', API1\User::class.'@index');//批量获取用户
            Route::get('/:user', API1\User::class.'@show');//获取单个用户
            
            Route::get('/:user/avatar', API1\UserAvatar::class.'@show');//获取用户头像
            
            Route::get('/:user/followers', API1\UserFollow::class.'@followers');//获取用户关注者
            Route::get('/:user/followings', API1\UserFollow::class.'@followings');//获取用户关注的用户
            
            Route::get('/:user/tags', API1\TagUser::class.'@userTgas');//获取用户标签
        });
        
        Route::put('user/retrieve-password', API1\ResetPassword::class.'@retrieve');//检索用户密码
        
        /*
        | -----------------------------------------------------------------------
        |定义一个路径，需要用户身份验证。
        | -----------------------------------------------------------------------
        |
        |这里定义的路由路径，需要用户
        |认证访问。
        |
        */
        Route::group(['middleware'=>'auth:api'], function(){
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
                Route::get('/', API1\CurrentUser::class.'@show');//获取当前用户
                Route::patch('/', API1\CurrentUser::class.'@update');//更新当前用户
                Route::put('/', API1\CurrentUser::class.'@updatePhoneOrMail');//更新当前用户的手机或者电子邮件
                
                Route::get('unread-count', API1\UserUnread::class.'@index');//查看用户未读消息统计
                
                Route::get('comments', API1\UserComment::class.'@index');//用户收到的评论
                
                Route::get('likes', API1\UserLike::class.'@index');//用户收到的赞
                                
                //用户认证  企业认证、个人认证
                Route::group('certification', function(){
                    Route::post('/', API1\UserCertification::class.'@store');//申请认证
                    Route::patch('/', API1\UserCertification::class.'@update');//更新认证
                    Route::get('/', API1\UserCertification::class.'@show');//获取用户的认证信息
                });
                
                //用户通知相关
                Route::group('notifications', function(){
                    Route::get('/', API1\UserNotification::class.'@index');//用户通知列表
                    Route::get(':notification', API1\UserNotification::class.'@show');//通知详情
                    Route::patch(':notification', API1\UserNotification::class.'@markAsRead');//阅读通知，可以使用资源模型阅读单条，也可以使用资源组形式，阅读标注多条.
                    Route::put('all', API1\UserNotification::class.'@markAllAsRead');//标记所有未读消息为已读
                });
                
                Route::post('feedback', API1\System::class.'@createFeedback');//发送一个反馈
                
                Route::post('avatar', API1\UserAvatar::class.'@update');//更新当前用户头像
                
                Route::post('bg', API1\CurrentUser::class.'@uploadBgImage');//更新经过身份验证的用户的背景图像
                
                //用户关注相关
                Route::group('followings', function(){
                    Route::get('/', API1\CurrentUser::class.'@followings');//我关注的人列表
                    Route::put('/:target', API1\CurrentUser::class.'@attachFollowingUser');//关注一个用户
                    Route::delete(':target', API1\CurrentUser::class.'@detachFollowingUser');//取消关注一个用户
                });
                
                //关注用户相关（关注我的）
                Route::group('followers', function(){
                    Route::get('/', API1\CurrentUser::class.'@followers');//获取关注我的用户
                });
                
                Route::put('/password', API1\ResetPassword::class.'@reset');//重置经过身份验证的用户的密码
                
                //已验证用户的标签相关
                Route::group('tags', function(){
                    Route::get('/', API1\TagUser::class.'@index');//获取经过身份验证的用户的所有标签
                    Route::put('/:tag', API1\TagUser::class.'@store');//添加了认证用户的一个标签
                    Route::delete('/:tag', API1\TagUser::class.'@destroy');//删除了认证用户的一个标签                
                });
                
                Route::post('/:target/rewards', API1\UserReward::class.'@store');//打赏用户
                
                Route::delete('/phone', API1\UserPhone::class.'@delete');//解除用户手机号码绑定
                
                Route::delete('/email', API1\UserEmail::class.'@delete');//解除用户电子邮件绑定
            });
            
            /*
             | --------------------------------------------------------------------
             |定义当前认证用户钱包操作路径。
             | --------------------------------------------------------------------
             |
             |定义当前已通过身份验证的用户钱包相关连的路线，
             |如获取获取钱包配置信息、获取提现记录，等等。
             |
             */
            Route::group('wallet', function(){
                Route::get('/', API1\WalletConfig::class.'@show');//获取钱包配置信息
                
                Route::get('/cashes', API1\WalletCash::class.'@show');//获取提现记录
                Route::post('/cashes', API1\WalletCash::class.'@store');//发起提现申请
                
                Route::post('/recharge', API1\WalletRecharge::class.'@store');//充值钱包余额
                Route::get('/charges', API1\WalletRecharge::class.'@list');//获取凭据列表
                Route::get('/charges/:charge', API1\WalletRecharge::class.'@show');//获取单条凭据
            });
            
            Route::get('/files/uploaded/:hash', API1\Files::class.'@uploaded');//检查一个文件的 md5, 如果存在着创建一个 file with id.
            
            Route::post('/files', API1\Files::class.'@store');//上传一个文件
            
            Route::get('/purchases/:node', API1\Purchase::class.'@show');//显示一个付费节点
            
            Route::post('/purchases/:node', API1\Purchase::class.'@pay');//为一个付费节点支付           
        });
    });
});
