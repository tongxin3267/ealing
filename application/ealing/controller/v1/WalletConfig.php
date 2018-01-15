<?php
/**
* 钱包配置
* @date: 2017年12月7日 下午6:05:11
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class WalletConfig extends BaseApi
{
    /**
    * 获取钱包配置信息
    * @date: 2017年12月7日 下午6:05:31
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function show()
	{
		return $this->sendSuccess(['show'], 'success', 200);
	}
}