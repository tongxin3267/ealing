<?php
/**
* 排行相关控制器
* @date: 2017年12月7日 下午3:48:45
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;

class Rank extends OpenApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 获取粉丝排行
    * @date: 2017年12月7日 下午3:49:21
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function followers()
	{
		return $this->sendSuccess(['followers'], 'success', 200);
	}
	
	/**
	* 获取财富排行
	* @date: 2017年12月7日 下午3:49:55
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function balance()
	{
	    return $this->sendSuccess(['balance'], 'success', 200);
	}
	
	/**
	* 获取收入排行
	* @date: 2017年12月7日 下午3:50:32
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function income()
	{
	    return $this->sendSuccess(['income'], 'success', 200);
	}
}