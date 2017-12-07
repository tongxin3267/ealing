<?php
/**
* 用户头像
* @date: 2017年12月7日 下午4:03:26
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;

class UserAvatar extends OpenApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 获取用户头像
    * @date: 2017年12月7日 下午4:06:12
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function show()
	{
		return $this->sendSuccess(['show'], 'success', 200);
	}
}