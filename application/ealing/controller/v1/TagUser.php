<?php
/**
* 用户标签相关
* @date: 2017年12月7日 下午4:07:26
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class TagUser extends AuthApi
{
    public $restMethodList = 'get|put';
    
    protected $openListAction = ['userTgas'];
    
    /**
    * 获取用户标签
    * @date: 2017年12月7日 下午4:07:46
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function userTgas()
	{
		return $this->sendSuccess(['userTgas'], 'success', 200);
	}
	
	/**
	* 获取经过身份验证的用户的所有标签
	* @date: 2017年12月7日 下午6:00:09
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function index()
	{
	    return $this->sendSuccess(['index'], 'success', 200);
	}
	
	/**
	* 添加了认证用户的一个标签
	* @date: 2017年12月7日 下午6:00:38
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function store()
	{
	    return $this->sendSuccess(['store'], 'success', 200);
	}
	
	/**
	* 删除了认证用户的一个标签  
	* @date: 2017年12月7日 下午6:01:02
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function destroy()
	{
	    return $this->sendSuccess(['destroy'], 'success', 200);
	}
}