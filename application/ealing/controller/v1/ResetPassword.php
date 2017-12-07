<?php
/**
* 重置密码
* @date: 2017年12月7日 下午4:09:04
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class ResetPassword extends AuthApi
{
    public $restMethodList = 'get|put';
    
    protected $openListAction = ['retrieve'];
    
    /**
    * 检索用户密码
    * @date: 2017年12月7日 下午4:09:23
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function retrieve()
	{
		return $this->sendSuccess(['retrieve'], 'success', 200);
	}
	
	/**
	* 重置经过身份验证的用户的密码
	* @date: 2017年12月7日 下午5:54:45
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function reset()
	{
	    return $this->sendSuccess(['reset'], 'success', 200);
	}
}