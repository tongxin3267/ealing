<?php

namespace app\ealing\controller;

use app\ealing\controller\UnauthorizedException;
use app\ealing\controller\Send;
use think\Exception;
use think\Request;
use think\Db;
use think\Cache;

class Oauth
{
    use Send;
    
    /**
     * accessToken存储前缀
     *
     * @var string
     */
    public static $accessTokenPrefix = 'accessToken_';

    /**
     * accessTokenAndClientPrefix存储前缀
     *
     * @var string
     */
    public static $accessTokenAndClientPrefix = 'accessTokenAndClient_';

    /**
     * 过期时间秒数
     *
     * @var int
     */
    public static $expires = 72000;

    /**
     * 客户端信息
     *
     * @var
     */
    public $clientInfo;
    
    public $options;

    /**
     * 控制器初始化操作
     */
    public function __construct($options = [])
    {
        $this->options = $options;
        $this->setType($options['type']);//设置反馈类型   根据mimeType判断
    }
    
    /**
     * 认证授权 通过用户信息和路由
     * @param Request $request
     * @return \Exception|UnauthorizedException|mixed|Exception
     * @throws UnauthorizedException
     */
    final function authenticate()
    {
        $request = Request::instance();

        try {
            $clientInfo = $this->getClient();
            $checkclient = $this->certification($clientInfo);
            if($checkclient === true) {
                //进行判断用户授权权限
                
                return $clientInfo;
            }
        } catch (Exception $e) {
            return $this->returnmsg(402,'Invalid1 authentication credentials.', [], ['Content-Type'=>$this->options['restOutputType'][$this->type]]);
        }
    }

    /**
     * 获取用户信息
     * @param Request $request
     * @return $this
     * @throws UnauthorizedException
     */
    public function getClient()
    {   
        $request = Request::instance();
        try {
            //========获取到token和user_id进行验证用户分配权限==============
            $clientInfo = $request->param();
        } catch (Exception $e) {
            return $this->returnmsg(402,$e.'Invalid authentication credentials', [], ['Content-Type'=>$this->options['restOutputType'][$this->type]]);
        }
        return $clientInfo;
    }

    /**
     * 获取用户信息后 验证权限
     * @return mixed
     */
    public function certification($data = []){
        //======下面注释部分是数据库验证access_token是否有效，示例为缓存中验证======
        $getCacheAccessToken = Cache::get(self::$accessTokenPrefix . $data['access_token']);  //获取缓存access_token
        if(!$getCacheAccessToken){
            return $this->returnmsg(402,'Access_token expired or error！', [], ['Content-Type'=>$this->options['restOutputType'][$this->type]]);
        }
        if($getCacheAccessToken['client']['app_key'] != $data['app_key']){
            return $this->returnmsg(402,'App_token does not match app_key', [], ['Content-Type'=>$this->options['restOutputType'][$this->type]]);  //app_key与缓存中的appkey不匹配
        }

        return true;
    }

    /**
     * 生成签名
     * _字符开头的变量不参与签名
     */
    public function makeSign($data = [],$app_secret = '')
    {
        unset($data['version']);
        unset($data['signature']);
        foreach ($data as $k => $v) {
            
            if(substr($data[$k],0,1) == '_'){

                unset($data[$k]);
            }
        }
        dump($data);
        return $this->_getOrderMd5($data,$app_secret);
    }

    /**
     * 计算ORDER的MD5签名
     */
    private function _getOrderMd5($params = [] , $app_secret = '') {
        ksort($params);
        $params['key'] = $app_secret;
        return strtolower(md5(urldecode(http_build_query($params))));
    }

}