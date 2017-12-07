<?php
/**
* 用户通知相关
* @date: 2017年12月7日 下午5:11:22
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class UserNotification extends AuthApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 用户通知列表
    * @date: 2017年12月7日 下午5:12:55
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function index()
	{
		return $this->sendSuccess(['index'], 'success', 200);
	}
	
	/**
	* 通知详情
	* @date: 2017年12月7日 下午5:12:42
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function show()
	{
	    return $this->sendSuccess(['show'], 'success', 200);
	}
	
	/**
	* 阅读通知，可以使用资源模型阅读单条，也可以使用资源组形式，阅读标注多条.
	* @date: 2017年12月7日 下午5:12:30
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function markAsRead()
	{
	    return $this->sendSuccess(['markAsRead'], 'success', 200);
	}
	
	/**
	* 标记所有未读消息为已读
	* @date: 2017年12月7日 下午5:12:21
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function markAllAsRead()
	{
	    return $this->sendSuccess(['markAllAsRead'], 'success', 200);
	}
}