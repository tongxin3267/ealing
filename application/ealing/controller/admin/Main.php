<?php
/**
* 后台入口地址
* @date: 2018年1月29日 上午9:41:51
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\admin;

class Main extends BaseController{
    /**
    * 后台登录
    * @date: 2018年1月29日 上午9:42:35
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function login(){
        return $this->fetch();
    }
    
    /**
    * 后台首页
    * @date: 2018年1月31日 上午10:14:58
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function store(){
        return $this->fetch();
    }
}