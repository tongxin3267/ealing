<?php
/**
* 广告相关控制器
* @date: 2017年12月7日 下午3:36:33
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;

class Advertising extends OpenApi
{
    public $restMethodList = 'get|put';

    /**
    * 获得广告空间
    * @date: 2017年12月7日 下午3:37:06
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function index()
    {
        return $this->sendSuccess(['index'], 'success', 200);
    }
    
    /**
    * 获得指定空间的广告数据
    * @date: 2017年12月7日 下午3:37:47
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function advertising()
    {
        return $this->sendSuccess(['advertising'], 'success', 200);
    }
    
    /**
    * 批量获取广告列表
    * @date: 2017年12月7日 下午3:38:54
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function batch()
    {
        return $this->sendSuccess(['batch'], 'success', 200);
    }
}