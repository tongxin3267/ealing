<?php
/**
* 付费节点
* @date: 2017年12月7日 下午6:05:11
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class Purchase extends BaseApi
{
    /**
    * 显示一个付费节点
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
	* 为一个付费节点支付
	* @date: 2017年12月7日 下午6:09:39
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function pay()
	{
	    return $this->sendSuccess(['pay'], 'success', 200);
	}
}