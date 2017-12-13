<?php
/**
* 授权基类
* @date: 2017年12月7日 下午12:08:49
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller;

use think\Controller;
use think\Request;
use app\ealing\controller\Factory;
use app\ealing\controller\Send;

class AuthApi extends Controller
{	
	use Send;

	/**
     * 对应操作
     * @var array
     */
    public $methodToAction = [
        'get' => 'read',
        'post' => 'save',
        'put' => 'update',
        'delete' => 'delete',
        'patch' => 'patch',
        'head' => 'head',
        'options' => 'options',
    ];
    /**
     * 允许访问的请求类型
     * @var string
     */
    public $restMethodList = 'get|post|put|delete|patch|head|options';
    /**
     * 默认验证
     * @var bool
     */
    protected $apiAuth = true;
    
    protected $openListAction = [];

	protected $request;
	/**
     * 当前请求类型
     * @var string
     */
    protected $method;
    /**
     * 当前资源类型
     * @var string
     */
    protected $type;

    public static $app;
    /**
     * 返回的资源类的
     * @var string
     */
    protected $restTypeList = 'json';
    /**
     * REST允许输出的资源类型列表
     * @var array
     */
    protected $restOutputType = [
        'xml'  => 'application/xml',
        'json' => 'application/json',
    ];

    /**
     * 客户端信息
     */
    protected $clientInfo;
    
	/**
	 * 控制器初始化操作
	 */
	public function _initialize()
    {
    	$this->request = Request::instance();
        $this->init();//检查资源类型
        
        if(!in_array($this->request->action(), $this->openListAction)) {
            $this->clientInfo = $this->checkAuth();//接口token检查
            $this->abilitieCheck();//请求接口授权认证[如果是外部商户请求则检测商户的指定权限]
        }
    } 

    /**
     * 初始化方法
     * 检测请求类型，数据格式等操作
     */
    public function init()
    {
    	// 资源类型检测
        $ext = $this->request->ext();
        if ('' == $ext) {
            // 自动检测资源类型
            $this->type = $this->request->type();
        } elseif (!preg_match('/\(' . $this->restTypeList . '\)$/i', $ext)) {
            // 资源类型非法 则用默认资源类型访问
            $this->type = $this->restDefaultType;
        } else {
            $this->type = $ext;
        }
        
        $this->setType($this->type);//设置反馈类型   根据mimeType判断
        
        // 请求方式检测
        $this->method = strtolower($this->request->method());
        if (false === stripos($this->restMethodList, $this->method)) {
            return self::returnmsg(405,'Method Not Allowed',[],["Access-Control-Allow-Origin" => $this->restMethodList, 'Content-Type' => $this->restOutputType[$this->type]]);
        }
    }

    /**
     * 检测客户端是否有权限调用接口
     */
    public function checkAuth()
    {
    	$baseAuth = Factory::getInstance(\app\ealing\controller\Oauth::class, ['type'=>$this->type, 'restOutputType'=>$this->restOutputType]);
    	$clientInfo = $baseAuth->authenticate();

    	return $clientInfo;
    }
    
    /**
    * 验证后台用户组权限
    * @date: 2017年12月13日 上午9:02:13
    * @author: onep2p <324834500@qq.com>
    * @return:
    */
    public function abilitieCheck()
    {
        $module = $this->request->module();
        $controller = explode('.', $this->request->controller())[1];
        $action = $this->request->action();
        
        if($this->request->has('signature') && Factory::getInstance(\app\ealing\controller\v1\Token::class)->checkTime()){
            /**
             * 外部商户SDK继承请求【当前默认全开权限】
             * 第一步：检测开通商户的用户【该用户依然可用来登录】
             * 第二步：以开通用户的节点使用权限验证商户权限【商户用户的权限为独立授权，可单个勾选，不分组】
             * 第三步：检测请求频率等【限制设置在商户信息中】
             * 
             * 商户的开通：
             * 第一步：注册基础会员
             * 第二步：开通商户
             * 第三步：申请或者购买商户权限
             * @var unknown
             */
            $result = true;
        }else{
            /**
             * 内部商户【平台自己商户下的用户】
             * 第一步：验证用户登录情况
             * 第二步：验证用户时候有该节点的使用权限
             * @var unknown
             */
            $result = true;
        }

        if(!$result) return self::returnmsg(401, 'node error!', [], ["Access-Control-Allow-Origin" => $this->restMethodList, 'Content-Type' => $this->restOutputType[$this->type]]);
        
        return true;
    }
    
    /**
     * 空操作
     * @return \think\Response|\think\response\Json|\think\response\Jsonp|\think\response\Xml
     */
    public function _empty()
    {
        return $this->sendSuccess([], 'empty method!', 200);
    }
}