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
Route::group('ealing', function(){
    Route::group('v1' , function(){
        Route::get('token','ealing/v1.Token/store');//初始授权地址
        Route::patch('tokens/:token', 'ealing/v1.Token/refresh');//刷新token
        
        Route::get('bootstrappers', 'ealing/v1.Bootstrappers/show');//启动信息
        
        Route::get('locations/search', 'ealing/v1.Location/search');//搜索位置
        
        Route::get('locations/hots', 'ealing/v1.Location/hots');//热门位置

        Route::get('advertisingspace/:space/advertising', 'ealing/v1.Advertising/advertising');//获取指定空间的广告数据
        Route::get('advertisingspace/advertising', 'ealing/v1.Advertising/batch');//批量获取广告列表
        Route::get('advertisingspace', 'ealing/v1.Advertising/index');//获得广告空间
        
        Route::get('aboutus', 'ealing/v1.System/about');//关于我们数据  html
        
        Route::get('tags', 'ealing/v1.Tag/index');//获取所有标签
        
        //验证码相关
        Route::group('verifycodes', function(){
            Route::post('register', 'ealing/v1.VerifyCode/storeByRegister');//注册验证码
            Route::get('/', 'ealing/v1.VerifyCode/store');//已存在用户验证码
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
                Route::get('/', 'ealing/v1.CurrentUser/show');//获取当前用户
                Route::patch('/', 'ealing/v1.CurrentUser/update');//更新当前用户
                Route::put('/', 'ealing/v1.CurrentUser/updatePhoneOrMail');//更新当前用户的手机或者电子邮件
                
                Route::get('unread-count', 'ealing/v1.UserUnread/index');//查看用户未读消息统计
                
                Route::get('comments', 'ealing/v1.UserComment/index');//用户收到的评论
                
                Route::get('likes', 'ealing/v1.UserLike/index');//用户收到的赞
                                
                //用户认证  企业认证、个人认证
                Route::group('certification', function(){
                    Route::post('/', 'ealing/v1.UserCertification/store');//申请认证
                    Route::patch('/', 'ealing/v1.UserCertification/update');//更新认证
                    Route::get('/', 'ealing/v1.UserCertification/show');//获取用户的认证信息
                });
                
                //用户通知相关
                Route::group('notifications', function(){
                    Route::get('/', 'ealing/v1.UserNotification/index');//用户通知列表
                    Route::get(':notification', 'ealing/v1.UserNotification/show');//通知详情
                    Route::patch(':notification', 'ealing/v1.UserNotification/markAsRead');//阅读通知，可以使用资源模型阅读单条，也可以使用资源组形式，阅读标注多条.
                    Route::put('all', 'ealing/v1.UserNotification/markAllAsRead');//标记所有未读消息为已读
                });
                
                Route::post('feedback', 'ealing/v1.System/createFeedback');//发送一个反馈
                
                Route::post('avatar', 'ealing/v1.UserAvatar/update');//更新当前用户头像
                
                Route::post('bg', 'ealing/v1.CurrentUser/uploadBgImage');//更新经过身份验证的用户的背景图像
                
                //用户关注相关
                Route::group('followings', function(){
                    Route::get('/', 'ealing/v1.CurrentUser/followings');//我关注的人列表
                    Route::put('/:target', 'ealing/v1.CurrentUser/attachFollowingUser');//关注一个用户
                    Route::delete(':target', 'ealing/v1.CurrentUser/detachFollowingUser');//取消关注一个用户
                });
                
                //关注用户相关（关注我的）
                Route::group('followers', function(){
                    Route::get('/', 'ealing/v1.CurrentUser/followers');//获取关注我的用户
                });
                
                Route::put('/password', 'ealing/v1.ResetPassword/reset');//重置经过身份验证的用户的密码
                
                //已验证用户的标签相关
                Route::group('tags', function(){
                    Route::get('/', 'ealing/v1.TagUser/index');//获取经过身份验证的用户的所有标签
                    Route::put('/:tag', 'ealing/v1.TagUser/store');//添加了认证用户的一个标签
                    Route::delete('/:tag', 'ealing/v1.TagUser/destroy');//删除了认证用户的一个标签                
                });
                
                Route::post('/:target/rewards', 'ealing/v1.UserReward/store');//打赏用户
                
                Route::delete('/phone', 'ealing/v1.UserPhone/delete');//解除用户手机号码绑定
                
                Route::delete('/email', 'ealing/v1.UserEmail/delete');//解除用户电子邮件绑定
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
                Route::get('/', 'ealing/v1.WalletConfig/show');//获取钱包配置信息
                
                Route::get('/cashes', 'ealing/v1.WalletCash/show');//获取提现记录
                Route::post('/cashes', 'ealing/v1.WalletCash/store');//发起提现申请
                
                Route::post('/recharge', 'ealing/v1.WalletRecharge/store');//充值钱包余额
                Route::get('/charges', 'ealing/v1.WalletCharge/list');//获取凭据列表
                Route::get('/charges/:charge', 'ealing/v1.WalletCharge/show');//获取单条凭据
            });
            
            Route::get('/files/uploaded/:hash', 'ealing/v1.Files/uploaded');//检查一个文件的 md5, 如果存在着创建一个 file with id.
            
            Route::post('/files', 'ealing/v1.Files/store');//上传一个文件
            
            Route::get('/purchases/:node', 'ealing/v1.Purchase/show');//显示一个付费节点
            
            Route::post('/purchases/:node', 'ealing/v1.Purchase/pay');//为一个付费节点支付           
        });
    });
    
    Route::group('admin', function(){
        Route::get('/', 'ealing/admin.Index/index');
    });
});
