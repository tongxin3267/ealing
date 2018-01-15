<?php
/**
* 授权基类
* @date: 2017年12月7日 下午12:08:49
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller;

use think\Controller;
use think\Request;
use app\ealing\controller\Send;
use think\Env;

class BaseApi extends Controller
{	
	use Send;

	protected $request;
	
	protected $type;//当前资源类型
	
	protected $app_key;//app密匙
	
	protected $token;//token基础信息
    
    /**
     * 构造函数
     * 初始化检测请求时间，签名等
     */
    public function __construct()
    {
        $this->request = Request::instance();
        $this->init();
        $this->initJwt();
    } 

    /**
    * 初始化方法
    * @date: 2018年1月15日 下午3:05:43
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function init()
    {
    	// 资源类型检测
        $this->type = empty($this->request->type()) ? $this->restDefaultType : $this->request->type();

        if (in_array($this->type, $this->restOutputType)) {
            $this->setType($this->type);//设置反馈类型   根据mimeType判断
        } else {
            $this->sendError(500, 'server error!!', 500);
        }
    }
    
    /**
    * 初始化token数据
    * @date: 2018年1月15日 下午3:05:27
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function initJwt()
    {
        $this->app_key = Env::get('APP_KEY');
        
        $this->token = array(
            "iss" => Env::get('APP_URL'),
            "iat" => $_SERVER['REQUEST_TIME'],
            "exp" => $_SERVER['REQUEST_TIME']+86400*30,//token令牌生命周期为30天
            "nbf" => $_SERVER['REQUEST_TIME']-300,//设置创建令牌前5分钟外不被接受
        );
    }
    
    /**
    * 验证用户是否有这个操作的权限
    * @date: 2018年1月15日 下午4:12:11
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function actionAuth()
    {
        //验证之前应该先验证token是否可用
    }
    
    /**
    * token验证
    * @date: 2018年1月15日 下午4:16:30
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    private function tokenCheck()
    {
        
    }
}