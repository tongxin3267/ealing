<?php
/**
* 基础控制器
* @date: 2018年1月31日 上午10:07:25
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\admin;

class BaseController extends Backstage
{
    /**
    * 重构fetch
    * @date: 2018年1月31日 上午10:06:59
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function fetch($template = '', $vars = [], $replace = [], $config = []){
        $template = empty($template) ? $this->request->action() : $template;
        $template = '/admin/' . $this->request->controller() . '/' . $template;

        return parent::fetch($template, $vars, $replace, $config);
    }
}