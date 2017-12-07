<?php
/**
* 用户手机
* @date: 2017年12月7日 下午6:05:11
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class UserPhone extends AuthApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 解除用户手机号码绑定
    * @date: 2017年12月7日 下午6:05:31
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function delete()
	{
		return $this->sendSuccess(['delete'], 'success', 200);
	}
}