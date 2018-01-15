<?php
/**
* 文件相关控制器
* @date: 2017年12月7日 下午3:52:04
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;

class Files extends BaseApi
{
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
	
	/**
	* 检查一个文件的 md5, 如果存在着创建一个 file with id.
	* @date: 2017年12月7日 下午6:07:34
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function uploaded()
	{
	    return $this->sendSuccess(['uploaded'], 'success', 200);
	}
	
	/**
	* 上传一个文件
	* @date: 2017年12月7日 下午6:08:00
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function store()
	{
	    return $this->sendSuccess(['store'], 'success', 200);
	}
}