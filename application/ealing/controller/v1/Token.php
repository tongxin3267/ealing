<?php
/**
* 获取accesstoken
* @date: 2017年12月1日 下午1:44:40
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller\v1;

use think\Controller;
use app\ealing\controller\BaseApi;
use app\ealing\controller\Send;
use Firebase\JWT\JWT;

class Token extends BaseApi
{
    use Send;

	/**
	* 创建一个令牌   即用户登录
	* @date: 2017年11月28日 下午3:00:15
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function store($uid = 0, $token_type = 'bearer')
	{
		try {
		    $this->token['uid'] = $uid;

		    $data = [
		        'token' => JWT::encode($this->token, $this->app_key),
		        'token_type' => $token_type,
		        'expires_in' => 3600
		    ];
		    
		    return $this->sendSuccess($data,'success',201);
		} catch (\Exception $e) {
		    $this->sendError(500, 'server error!!', 500);
		}
	}
	
	/**
	* 刷新用户令牌
	* @date: 2017年12月13日 上午11:05:12
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function refresh()
	{
	    try {
	        $token = $this->request->param('token');
	         
	        $decoded = JWT::decode($token, $this->app_key, array('HS256'));
	        
	        //验证用户数据

	        $this->token['uid'] = $decoded->uid;
	        $data = [
	            'token' => JWT::encode($this->token, $this->app_key),
	            'token_type' => 'bearer',
	            'expires_in' => 3600
	        ];
	    
	        return $this->sendSuccess($data,'success',201);
	    } catch (\Exception $e) {
	        $this->sendError(500, 'server error!!', 500);
	    }
	}

    /**
     * 生成AccessToken
     * @return string
     */
    protected static function buildAccessToken($lenght = 32)
    {
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
		return substr(str_shuffle($str_pol), 0, $lenght);

    }
}