<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/8
 */
namespace app\ealing\controller\admin\builder;

use think\Controller;

class BackstageBuilder extends Controller{
    public function display($templateFile='',$charset='',$contentType='',$content='',$prefix='') {
        //获取模版的名称
        $template = '/admin/builder/'.$templateFile;
        //显示页面
        return Controller::display($template);
    }
}