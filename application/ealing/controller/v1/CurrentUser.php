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
		return $this->sendSuccess(['tags'], 'success', 200);
	}
}