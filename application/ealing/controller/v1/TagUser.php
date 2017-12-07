<?php
/**
* 用户标签相关
* @date: 2017年12月7日 下午4:07:26
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;

class TagUser extends OpenApi
{
    public $restMethodList = 'get|put';
    
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
}