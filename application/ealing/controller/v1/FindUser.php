<?php
/**
* 定于公开用户的相关信息
* @date: 2017年12月7日 下午3:53:49
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class FindUser extends BaseApi
{
    /**
    * 通过手机号查找
    * @date: 2017年12月7日 下午3:54:23
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function findByPhone()
	{
		return $this->sendSuccess(['findByPhone'], 'success', 200);
	}
	
	/**
	* 热门用户, 根据粉丝数量倒序排列
	* @date: 2017年12月7日 下午3:54:44
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function populars()
	{
	    return $this->sendSuccess(['populars'], 'success', 200);
	}
	
	/**
	* 最新用户,按注册时间倒序
	* @date: 2017年12月7日 下午3:55:05
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function latests()
	{
	    return $this->sendSuccess(['latests'], 'success', 200);
	}
	
	/**
	* 推荐用户
	* @date: 2017年12月7日 下午3:55:28
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function recommends()
	{
	    return $this->sendSuccess(['recommends'], 'success', 200);
	}
	
	/**
	* 搜索用户
	* @date: 2017年12月7日 下午3:55:50
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function search()
	{
	    return $this->sendSuccess(['search'], 'success', 200);
	}
	
	/**
	* 通过标签推荐用户
	* @date: 2017年12月7日 下午3:56:12
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function findByTags()
	{
	    return $this->sendSuccess(['findByTags'], 'success', 200);
	}
}