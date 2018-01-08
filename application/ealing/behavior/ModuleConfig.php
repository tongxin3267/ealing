<?php
/**
* 载入模块指定目录配置、扩展、行为等
* @date: 2017年12月6日 上午11:05:41
* @author: onep2p <324834500@qq.com>
*/

namespace app\ealing\behavior;

use think\Config;
use think\Hook;

class ModuleConfig{
    /**
    * 运行行为
    * @date: 2017年12月6日 上午11:05:23
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function run(&$params){
        $module = isset($params['module'][0]) ? $params['module'][0] : 'ealing';
        
        // 载入公开助手函数库
        $this->loadHelper();
        
        if($module){
            // 加载模块配置
            $config = Config::load(APP_PATH . $module . '/config/config' . CONF_EXT);

            // 读取数据库配置文件
            $filename = APP_PATH . $module . '/config/database' . CONF_EXT;
            Config::load($filename, 'database');
            // 读取扩展配置文件
            if (is_dir(APP_PATH . $module . '/config/extra')) {
                $dir   = APP_PATH . $module . '/config/extra';
                $files = scandir($dir);
                foreach ($files as $file) {
                    if ('.' . pathinfo($file, PATHINFO_EXTENSION) === CONF_EXT) {
                        $filename = $dir . DS . $file;
                        Config::load($filename, pathinfo($file, PATHINFO_FILENAME));
                    }
                }
            }
            
            // 加载应用状态配置
            if ($config['app_status']) {
                $config = Config::load(APP_PATH . $module . '/config/' . $config['app_status'] . CONF_EXT);
            }
            
            // 加载行为扩展文件
            if (is_file(APP_PATH . $module . '/config/tags' . CONF_EXT)) {
                Hook::import(include APP_PATH . $module . '/config/tags' . CONF_EXT);
            }
            
            
            // 加载模块独立助手函数库
            $this->loadHelper($module);
        }
    }
    
    /**
    * loader helper lib
    * @date: 2018年1月8日 下午5:24:55
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function loadHelper($module = ''){
        if(empty($module)){
            $apps = scandir(APP_PATH);
            foreach ($apps as $app){
                if('.' == $app || '..' == $app || 'ealing' == $app) continue;
                
                include APP_PATH . $app . '/config/publicHelper' . CONF_EXT;
            }
        }else{
            include APP_PATH . $module . '/config/privateHelper' . CONF_EXT;
        }
    }
}