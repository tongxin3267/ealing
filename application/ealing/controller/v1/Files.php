<?php
/**
* 文件相关控制器
* @date: 2017年12月7日 下午3:52:04
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;

class Files extends OpenApi
{
    public $restMethodList = 'get|put';
    
    /**
    * 获取文件
    * @date: 2017年12月7日 下午3:52:36
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function show()
	{
		return $this->sendSuccess(['show'], 'success', 200);
	}
}