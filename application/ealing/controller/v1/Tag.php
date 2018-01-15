<?php
/**
* 标签控制器
* @date: 2017年12月7日 上午10:28:26
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;
use app\ealing\model\TagCategorie;

class Tag extends BaseApi
{
    /**
    * 获取所有标签
    * @date: 2017年12月7日 下午4:09:56
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
	public function index(TagCategorie $categoryModel)
	{
		return $this->sendSuccess($categoryModel::get(function($query){
		    $query->with('tags');
		    $query->order('weight desc');
		}), 'success', 200);
	}
}