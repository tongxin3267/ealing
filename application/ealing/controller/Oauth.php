<?php

namespace app\ealing\controller;

use app\ealing\controller\UnauthorizedException;
use app\ealing\controller\Send;
use think\Exception;
use think\Request;
use think\Db;
use think\Cache;
use app\ealing\model\CachesToken;

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
        $getCacheAccessToken = CachesToken::get(function($query) use($data){
            $query->field('user_id');
            $query->where('access_token', $data['access_token']);
        });

        if(!$getCacheAccessToken){
            return $this->returnmsg(402,'Access_token expired or error！', [], ['Content-Type'=>$this->options['restOutputType'][$this->type]]);
        }

        if($getCacheAccessToken['user_id'] > 0) {
            $getLastAccessToken = CachesToken::get(function($query) use($getCacheAccessToken){
                $query->field('access_token');
                $query->order('created_at desc');
                $query->where('user_id', $getCacheAccessToken['user_id']);
            });
            
            if($getLastAccessToken['access_token'] !== $data['access_token']) return $this->returnmsg(402,'Log in on other clients！', [], ['Content-Type'=>$this->options['restOutputType'][$this->type]]);
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
            if(substr($data[$k],0,1) == '_') unset($data[$k]);
        }
        
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