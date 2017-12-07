<?php
/**
* 标签控制器
* @date: 2017年12月7日 上午10:28:26
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class Tag extends AuthApi
{
    public $restMethodList = 'get|put';
    
	public function index()
	{
		return $this->sendSuccess(['tags'], 'success', 200);
	}
}