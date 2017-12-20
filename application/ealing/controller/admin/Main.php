<?php
/**
* 主程序后台入口地址
* @date: 2017年12月20日 下午2:03:10
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\admin;

use app\ealing\controller\AuthApi;

class Main extends AuthApi
{
    protected $openListAction = ['store'];
    
    public function store()
    {
        return $this->sendError();
    }
}