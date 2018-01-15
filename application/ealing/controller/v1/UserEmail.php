<?php
/**
* 用户邮件
* @date: 2017年12月7日 下午6:05:11
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class UserEmail extends BaseApi
{
    /**
    * 解除用户电子邮件绑定
    * @date: 2017年12月7日 下午6:05:31
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function delete()
	{
		return $this->sendSuccess(['delete'], 'success', 200);
	}
}