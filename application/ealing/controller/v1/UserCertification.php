<?php
/**
* 用户认证
* @date: 2017年12月7日 下午5:06:29
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class UserCertification extends BaseApi
{
    /**
    * 申请认证
    * @date: 2017年12月7日 下午5:07:01
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function store()
	{
		return $this->sendSuccess(['store'], 'success', 200);
	}
	
	/**
	* 更新认证
	* @date: 2017年12月7日 下午5:07:25
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function update()
	{
	    return $this->sendSuccess(['update'], 'success', 200);
	}
	
	/**
	* 获取用户的认证信息
	* @date: 2017年12月7日 下午5:07:42
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function show()
	{
	    return $this->sendSuccess(['show'], 'success', 200);
	}
}