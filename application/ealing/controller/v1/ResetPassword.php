<?php
/**
* 重置密码
* @date: 2017年12月7日 下午4:09:04
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;

class ResetPassword extends OpenApi
{
    public $restMethodList = 'get|put';
    
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
}