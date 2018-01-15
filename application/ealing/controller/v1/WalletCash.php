<?php
/**
* 提现
* @date: 2017年12月7日 下午6:05:11
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class WalletCash extends BaseApi
{
    /**
    * 获取提现记录
    * @date: 2017年12月7日 下午6:05:31
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function show()
	{
		return $this->sendSuccess(['show'], 'success', 200);
	}
	
	/**
	* 发起提现申请
	* @date: 2017年12月7日 下午6:11:55
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function store()
	{
	    return $this->sendSuccess(['store'], 'success', 200);
	}
}