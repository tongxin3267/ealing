<?php
/**
* 打赏
* @date: 2017年12月7日 下午6:02:59
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class UserReward extends BaseApi
{
    /**
    * 打赏用户
    * @date: 2017年12月7日 下午6:03:30
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function store()
	{
		return $this->sendSuccess(['store'], 'success', 200);
	}
}