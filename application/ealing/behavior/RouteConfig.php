<?php
/**
* 载入路由配置行为
* @date: 2017年12月20日 上午11:39:45
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\behavior;

class RouteConfig
{
    public function run()
    {
        $route = [];
        $apps = scandir(APP_PATH);
        foreach ($apps as $app){
            if('.' == $app || '..' == $app) continue;
        
            //载入前端所有路由
            if(is_dir(APP_PATH . $app) && is_readable(APP_PATH . $app . '/route/web.php') == true) {
                $route[] = '../application/' . $app . '/route/web';
            }
        
            //载入后端所有路由
            if(is_dir(APP_PATH . $app) && is_readable(APP_PATH . $app . '/route/admin.php') == true) {
                $route[] = '../application/' . $app . '/route/admin';
            }
        }
        
        config('route_config_file', $route);
    }
}