<?php
/**
* 充值
* @date: 2017年12月7日 下午6:12:43
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class WalletRecharge extends AuthApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 充值钱包余额
    * @date: 2017年12月7日 下午6:13:05
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function store()
	{
		return $this->sendSuccess(['store'], 'success', 200);
	}
	
	/**
	* 获取凭据列表
	* @date: 2017年12月7日 下午6:13:28
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function list()
	{
	    return $this->sendSuccess(['list'], 'success', 200);
	}
	
	/**
	* 获取单条凭据
	* @date: 2017年12月7日 下午6:13:48
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function show()
	{
	    return $this->sendSuccess(['show'], 'success', 200);
	}
}