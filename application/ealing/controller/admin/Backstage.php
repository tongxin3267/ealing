<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/8
 */
namespace app\ealing\controller\admin;

use think\Controller;
use think\Config;

class Backstage extends Controller{
    public function _initialize()
    {
        $this->init();
    }
    
    private function init()
    {
        /* 自定义解析路由 */
        $route = $this->request->routeInfo()['route'];
        list($dispatch, $actionName) = explode('@', $route);
        list($appNamespace, $moduleName, $controller, $controllerV, $controllerName) = explode('\\', $dispatch);
        

        $this->request->module($moduleName);//设置当前模块
        $this->request->controller($controllerName);//设置当前控制器
        $this->request->action($actionName);//设置当前操作
        
        /* 设置当前模块下的侧边栏目数据 */
        $this->moduleMenu();
    }
    
    /**
    * 获取当前模块的侧边栏目
    * @date: 2018年1月24日 上午11:05:02
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function moduleMenu()
    {
        $module = $this->request->module();
        $controller = strtolower($this->request->controller());
        $action = strtolower($this->request->action());
        
        /* 载入安装模块导航  */
        $apps = scandir(APP_PATH);
        $topMenu = ['active' => empty($module) ? 'ealing' : $module, 'menu' => []];
        foreach ($apps as $app){
            if('.' == $app || '..' == $app) continue;
        
            $set = include APP_PATH . $app . '/config/summary' . CONF_EXT;
            if(sizeof($set) > 0){
                $topMenu['menu'][] = ['alias' => $set['alias'], 'icon' => $set['icon'], 'title' => $set['title'], 'path' => $set['path'], 'sort' => $set['sort']];
            }
        }
        
        $topMenu['menu'] = my_sort($topMenu['menu'], 'sort');
        
        $summary = include APP_PATH . $module . '/config/summary' . CONF_EXT;
        $summary['open'] = $summary['open'] == $controller ? $summary['open'] : [$controller];
        $summary['active'] = $summary['active'] == $action ? $summary['active'] : $action;

        $this->assign('topMenu', json_encode($topMenu));
        $this->assign('summary', json_encode($summary));
    }
}