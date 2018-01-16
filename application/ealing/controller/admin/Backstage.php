<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/8
 */
namespace app\ealing\controller\admin;

use think\Controller;
use think\Request;
use think\View;
use think\Config;

class Backstage extends Controller{

    /**
     * 构造函数
     * @param Request $request Request对象
     * @access public
     */
    public function __construct(Request $request = null)
    {

        if (is_null($request)) {
            $request = Request::instance();
        }

        $this->request = $request;

        $this->_initializeView();
        $this->view = View::instance(Config::get('template'), Config::get('view_replace_str'));


        // 控制器初始化
        $this->_initialize();

        // 前置操作方法
        if ($this->beforeActionList) {
            foreach ($this->beforeActionList as $method => $options) {
                is_numeric($method) ?
                    $this->beforeAction($options) :
                    $this->beforeAction($method, $options);
            }
        }

        $this->assign('__MENU__', ['main'=>[]]);
    }

    // 初始化视图配置
    protected function _initializeView()
    {

    }





}