<?php
/**
* 用户收到的赞
* @date: 2017年12月7日 下午5:05:33
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class UserLike extends AuthApi
{
    public $restMethodList = 'get|put';
    
   /**
   * 用户收到的赞
   * @date: 2017年12月7日 下午5:05:38
   * @author: onep2p <324834500@qq.com>
   * @param: variable
   * @return:
   */
	public function index()
	{
		return $this->sendSuccess(['index'], 'success', 200);
	}
}