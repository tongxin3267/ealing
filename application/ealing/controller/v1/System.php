<?php
/**
* 系统相关控制器
* 有反馈、关于我们等数据
* @date: 2017年12月7日 下午3:41:06
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\AuthApi;

class System extends AuthApi
{
    public $restMethodList = 'get|put';
    
    protected $openListAction = ['about'];

    /**
    * 关于我们
    * @date: 2017年12月7日 下午3:42:49
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function about()
    {
        return $this->sendSuccess(['about'], 'success', 200);
    }
    
    /**
    * 发送一个反馈
    * @date: 2017年12月7日 下午5:13:42
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function createFeedback()
    {
        return $this->sendSuccess(['createFeedback'], 'success', 200);
    }
}