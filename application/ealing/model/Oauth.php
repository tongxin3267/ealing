<?php
/**
* 授权模型类
* @date: 2017年12月12日 下午1:47:49
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class Oauth extends BaseModel{

	/**
	 * 表名,
	 */
	//protected $table = 'cfg_oauth';//当模块表和主配置不统一的时候可用   这里直接使用官方的前缀

	/**
	 * 只读
	 */
	protected $readonly = ['app_key'];
	
	// 设置返回数据集为数组
	protected $resultSetType = '';

	/**
	 * 验证合法的appkey
	 * @param appkey 
	 * @return true|false
	 */
	public function checkAppkey($app_key = '')
	{
		return false;
	}
}