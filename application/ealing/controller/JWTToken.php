<?php
/**
* token类
* @date: 2018年3月1日 上午10:12:36
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller;

use Lcobucci\JWT\Builder;
use think\Env;
use app\ealing\model\JwtCaches as JWTCacheModel;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class JWTToken
{
    /**
     * 创建用户token
     * @date: 2018年2月28日 下午4:53:25
     * @author: onep2p <324834500@qq.com>
     * @param: variable
     * @return:
     */
    public function createToken($user)
    {
        $signerKey = Env::get('APP_KEY');
        return $this->token(
           (string) (new Builder())
                ->setIssuer(Env::get('APP_URL'))
                ->setAudience(Env::get('APP_URL'))
                ->setId($signerKey, true)
                ->setIssuedAt($_SERVER['REQUEST_TIME'])
                ->setExpiration($_SERVER['REQUEST_TIME'] + config('token.ttl')*60)
                ->set('uid', $user->id)
                ->getToken()
        );
    }
    
    /**
     * 刷新token
     * @date: 2018年2月28日 下午4:53:56
     * @author: onep2p <324834500@qq.com>
     * @param: variable
     * @return:
     */
    public function refreshToken($token)
    {
        
    }
    
    /**
    * token验证
    * @date: 2018年3月1日 上午11:55:06
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function validation($token)
    {
        try {
            $signerKey = Env::get('APP_KEY');
            
            $parseToken = (new Parser())->parse($token);
            $validata = new ValidationData();
            $validata->setIssuer(Env::get('APP_URL'));
            $validata->setAudience(Env::get('APP_URL'));
            $validata->setId($signerKey);
            if(!$parseToken->validate($validata)){
                return [
                    'status'=>'fail',
                    'msg'=>'validation fail',
                ];
            }else{
                return 1;
            }
        }catch(\Exception $e){
            return [
                'status'=>'fail',
                'msg'=>$e->getMessage(),
            ];
        }
    }
    
    /**
     * 获取token
     * @date: 2018年2月28日 下午4:51:04
     * @author: onep2p <324834500@qq.com>
     * @param: variable
     * @return:
     */
    private function token($token)
    {
        $parseToken = (new Parser())->parse($token);
        
        $cache = new JWTCacheModel();
        $cache->user_id = $parseToken->getClaim('uid');
        $cache->key = $this->buildTokenKey(64);
        $cache->values = $token;
        $cache->expires = ($parseToken->getClaim('exp') - $parseToken->getClaim('iat')) / 60;
        $cache->minutes = config('token.refresh_ttl');
        $cache->status = 1;
        $cache->save();
    
        return $token;
    }
	
	
	/**
	* 生成tokenKey
	* @date: 2018年3月6日 上午8:50:22
	* @author: onep2p <324834500@qq.com>
	* @param: variable
	* @return: string
	*/
	private static function buildTokenKey($lenght = 32)
	{
	    $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
	    return substr(str_shuffle($str_pol), 0, $lenght);
	
	}
}