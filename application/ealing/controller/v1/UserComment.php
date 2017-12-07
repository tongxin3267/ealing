<?php
/**
* 用户评论
* @date: 2017年12月7日 下午5:02:32
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class UserComment extends AuthApi
{
    public $restMethodList = 'get|put';
    
   /**
   * 用户收到的评论
   * @date: 2017年12月7日 下午5:03:34
   * @author: onep2p <324834500@qq.com>
   * @param: variable
   * @return:
   */
	public function index()
	{
		return $this->sendSuccess(['index'], 'success', 200);
	}
}