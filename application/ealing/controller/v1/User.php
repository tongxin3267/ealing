<?php

namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\OpenApi;


class User extends OpenApi
{
    public $restMethodList = 'get|post|put';
    
    /**
    * 创建一个用户
    * @date: 2017年12月7日 下午3:59:38
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function store()
    {
        return $this->sendSuccess(['store'], 'success', 200);
    }
    
    /**
    * 批量获取用户
    * @date: 2017年12月7日 下午3:59:47
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function index()
    {
        return $this->sendSuccess(['index'], 'success', 200);
    }
    
    /**
    * 获取单个用户
    * @date: 2017年12月7日 下午3:59:55
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function show()
    {
        return $this->sendSuccess(['show'], 'success', 200);
    }
}
