<?php
/**
* 后台入口地址
* @date: 2018年1月29日 上午9:41:51
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\admin;

use think\Controller;

class Main extends Controller{
    /**
    * 后台登录
    * @date: 2018年1月29日 上午9:42:35
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function login(){
        return $this->fetch('admin/login');
    }
}