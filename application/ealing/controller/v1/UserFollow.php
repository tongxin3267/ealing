<?php
/**
* 用户关注相关（关注与被关注）
* @date: 2017年12月7日 下午4:05:26
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class UserFollow extends BaseApi
{
    /**
    * 获取用户关注者
    * @date: 2017年12月7日 下午4:06:25
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function followers()
	{
		return $this->sendSuccess(['followers'], 'success', 200);
	}
	
	/**
	* 获取用户关注的用户
	* @date: 2017年12月7日 下午4:06:35
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function followings()
	{
	    return $this->sendSuccess(['followings'], 'success', 200);
	}
}