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
use app\ealing\controller\JWTToken as JWT;
use app\ealing\model\User as User;
use think\Env;

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
	public function store(JWT $jwtToken, User $model)
	{
		try {
		    //:DOTO 用户验证
		    $login = input('get.login', 'root', 'htmlspecialchars');
		    $password = input('password', 'root', 'htmlspecialchars');

		    //$user = $model->where(username($login), $login)->with('wallet')->withCount('administrator')->first();
            $user = $model->where(username($login), $login)->with('wallet')->find();
            if(! $user) {
                return $this->sendError(404, 'error', 404, ['login' => ['用户不存在']]);
            } elseif(EalingEncrypt($password, Env::get('APP_KEY')) !== $user->password) {
                return $this->sendError(422, 'error', 422, ['password' => ['密码错误']]);
            } elseif ($token = $jwtToken->createToken($user)) {
                return $this->sendSuccess([
                    'token' => $token,
                    'token_type' => 'admin',
                    'expires_in' => config('token.ttl'),
                    'refresh_ttl' => config('token.refresh_ttl')
                ],'success',201);
            }

		    return $this->sendError(500, 'error', 500, ['message' => ['Failed to create token.']]);
		} catch (\Exception $e) {
		    $this->sendError(500, 'error', 500, ['message' => ['Failed to create token.']]);
		}
	}
	
	/**
	* 刷新用户令牌
	* @date: 2017年12月13日 上午11:05:12
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return:
	*/
	public function refresh(JWT $jwtToken)
	{
	    try {
	        $patchData = file_get_contents("php://input");
	        $patchData = json_decode($patchData, true);
	        
	        if(isset($patchData['token']) && !empty($patchData['token'])) {
	            if($token = $jwtToken->refreshToken($patchData['token'])) {
	                return $this->sendSuccess([
	                    'token' => $token,
	                    'token_type' => 'admin',
	                    'expires_in' => config('token.ttl'),
	                    'refresh_ttl' => config('token.refresh_ttl')
	                ],'success',201);
	            }
	        } else {
	            $this->sendError(402, 'get server error!!', 402);
	        }
	    } catch (\Exception $e) {
	        $this->sendError(500, 'server error!!', 500);
	    }
	}
}