<?php
/**
* 位置控制器
* @date: 2017年12月7日 上午10:19:54
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\Api;

class Location extends Api
{
    public $restMethodList = 'get|put';

    /**
    * get请求的城市搜索
    * @date: 2017年12月7日 上午10:20:51
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function search()
    {
        return $this->sendSuccess(['search'], 'success', 200);
    }
    
    /**
    * get请求的热门城市
    * @date: 2017年12月7日 上午10:21:10
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function hots()
    {
        return $this->sendSuccess(['hots'], 'success', 200);
    }
}