<?php
/**
* 通过验证的用户操作
* @date: 2017年12月7日 下午3:28:54
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class CurrentUser extends AuthApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 获取当前用户
    * @date: 2017年12月7日 下午3:29:36
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function show()
	{
	    return $this->sendSuccess(['show'], 'success', 200);
	}
	
	/**
	* 更新当前用户
	* @date: 2017年12月7日 下午5:50:02
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function update()
	{
	    return $this->sendSuccess(['update'], 'success', 200);
	}
	
	/**
	* 更新当前用户的手机或者电子邮件
	* @date: 2017年12月7日 下午5:50:25
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function updatePhoneOrMail()
	{
	    return $this->sendSuccess(['updatePhoneOrMail'], 'success', 200);
	}
	
	/**
	* 更新经过身份验证的用户的背景图像
	* @date: 2017年12月7日 下午5:48:41
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function uploadBgImage()
	{
	    return $this->sendSuccess(['uploadBgImage'], 'success', 200);
	}
	
	/**
	* 我关注的人列表
	* @date: 2017年12月7日 下午5:51:05
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function followings()
	{
	    return $this->sendSuccess(['followings'], 'success', 200);
	}
	
	/**
	* 关注一个用户
	* @date: 2017年12月7日 下午5:51:32
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function attachFollowingUser()
	{
	    return $this->sendSuccess(['attachFollowingUser'], 'success', 200);
	}
	
	/**
	* 取消关注一个用户
	* @date: 2017年12月7日 下午5:51:56
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function detachFollowingUser()
	{
	    return $this->sendSuccess(['detachFollowingUser'], 'success', 200);
	}
	
	/**
	* 获取关注我的用户
	* @date: 2017年12月7日 下午5:52:39
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function followers()
	{
	    return $this->sendSuccess(['followers'], 'success', 200);
	}
}