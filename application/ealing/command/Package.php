<?php
/**
* 生成拓展的命令
* @date: 2017年12月6日 下午4:02:24
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\command;
use think\console\Command;
use think\console\input\Option;
use think\console\Input;
use think\console\Output;
class Package extends Command
{
    private $list = [
        '__file__'   => [],
        '__dir__'    => ['config', 'controller/admin', 'controller/v1', 'model', 'route', 'services'],
        'config'     => ['config'],
        'controller/admin' => ['home'],
        'controller/v1' => ['home'],
        'model'      => [],
        'route'      => ['admin', 'web'],
        'services'   => [],
    ];
    
    /**
    * 设置命令信息
    * @date: 2017年12月6日 下午4:07:32
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    protected function configure()
    {
        $this
            ->setName('package')
            ->setDescription('Here is the create package')
            ->addOption('packageName', 'd', Option::VALUE_OPTIONAL, 'Here is the package Name', null);
    }
    
    /**
    * 执行命令
    * @date: 2017年12月6日 下午4:07:44
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    protected function execute(Input $input, Output $output)
    {
        $packageName = $input->getOption('packageName');
        
        $this->module($packageName, $this->list);
        $output->writeln("Successed");
    }
    
    private function module($module = '', $list = [], $namespace = 'app', $suffix = false)
    {
        $module = $module ? $module : '';
        if (!is_dir(APP_PATH . $module)) {
            // 创建模块目录
            mkdir(APP_PATH . $module);
        }
        
        if (empty($list)) {
            // 创建默认的模块目录和文件
            $list = [
                '__file__' => [],
                '__dir__'  => ['config', 'controller', 'model', 'route', 'services'],
            ];
        }
        // 创建子目录和文件
        foreach ($list as $path => $file) {
            $modulePath = APP_PATH . $module . DS;
            if ('__dir__' == $path) {
                // 生成子目录
                foreach ($file as $dir) {
                    $this->checkDirBuild($modulePath . $dir);
                }
            } elseif ('__file__' == $path) {
                // 生成（空白）文件
                foreach ($file as $name) {
                    if (!is_file($modulePath . $name)) {
                        file_put_contents($modulePath . $name, 'php' == pathinfo($name, PATHINFO_EXTENSION) ? "<?php\n" : '');
                    }
                }
            } else {
                // 生成相关MVC文件
                foreach ($file as $val) {
                    $val      = trim($val);
                    $filename = $modulePath . $path . DS . $val . ($suffix ? ucfirst($path) : '') . EXT;
                    $space    = $namespace . '\\' . ($module ? $module . '\\' : '') . $path;
                    $class    = $val . ($suffix ? ucfirst($path) : '');
                    switch ($path) {
                        case 'config': //配置
                            $content = "<?php\nreturn [\n\n];";
                            break;
                        case 'controller/admin': // 后台控制器
                        case 'controller/v1': // 前端控制器
                            $controllerSpace = str_replace('/', '\\', $space);
                            if($path === 'controller/v1') $class = ucfirst($module);
                            $content = "<?php\nnamespace {$controllerSpace};\n\nclass {$class}\n{\n\n}";
                            break;
                        case 'model': // 模型
                            $content = "<?php\nnamespace {$space};\n\nuse think\Model;\n\nclass {$class} extends Model\n{\n\n}";
                            break;
                        case 'route': // 路由
                            $filename = $modulePath . $path . DS . $val . EXT;
                            $this->checkDirBuild(dirname($filename));
                            $content = "<?php\nuse think\Route;\n\n";
                            break;
                        case 'services': // 服务
                            $content = "<?php\nnamespace {$space};\n\nclass {$class}\n{\n\n}";
                            break;
                        default:
                            // 其他文件
                            $content = "<?php\nnamespace {$space};\n\nclass {$class}\n{\n\n}";
                    }
        
                    if (!is_file($filename)) {
                        if($path == 'controller/v1') $filename = $modulePath . str_replace('/', '\\', $path) . DS . ucfirst($module) . ($suffix ? ucfirst($path) : '') . EXT;;
  
                        file_put_contents($filename, $content);
                    }
                }
            }
        }        
    }
    
    /**
     * 创建模块的公共文件
     * @access public
     * @param  string $module 模块名
     * @return void
     */
    protected static function buildCommon($module)
    {
        $filename = CONF_PATH . ($module ? $module . DS : '') . 'config.php';
    
        self::checkDirBuild(dirname($filename));
        if (!is_file($filename)) {
            file_put_contents($filename, "<?php\n//配置文件\nreturn [\n\n];");
        }
        $filename = APP_PATH . ($module ? $module . DS : '') . 'common.php';
        if (!is_file($filename)) {
            file_put_contents($filename, "<?php\n");
        }
    }
    
    protected static function checkDirBuild($dirname)
    {
        if (!is_dir($dirname)) {
            mkdir($dirname, 0755, true);
        }
    }    
}