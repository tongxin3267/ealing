<?php
/**
* 用户未读消息
* @date: 2017年12月7日 下午4:42:15
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class UserUnread extends AuthApi
{
    public $restMethodList = 'get|put';
    
   /**
   * 查看用户未读消息统计
   * @date: 2017年12月7日 下午4:42:43
   * @author: onep2p <324834500@qq.com>
   * @param: variable
   * @return:
   */
	public function index()
	{
		return $this->sendSuccess(['index'], 'success', 200);
	}
}