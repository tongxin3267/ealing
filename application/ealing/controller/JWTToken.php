<?php
/**
* token类
* @date: 2018年3月1日 上午10:12:36
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\controller;

use Lcobucci\JWT\Signer\Hmac\Sha256;
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
        $signer = new Sha256();
        $signerKey = Env::get('APP_KEY');
        return $this->token(
           (string) (new Builder())
                ->setIssuer(Env::get('APP_URL'))
                ->setAudience(Env::get('APP_URL'))
                ->setIssuedAt($_SERVER['REQUEST_TIME'])
                ->setExpiration($_SERVER['REQUEST_TIME'] + config('token.ttl')*60)
                ->set('uid', $user['uid'])
                ->sign($signer, $signerKey)
                ->getToken(), $user
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
        $signer = new Sha256();
        $signerKey = Env::get('APP_KEY');
        
        $parseToken = (new Parser())->parse($token);
        if(!$parseToken->verify($signer,$signerKey)){
            
        }
        
        $validata = new ValidationData();
        $validata->setIssuer(Env::get('APP_URL'));
        $validata->setAudience(Env::get('APP_URL'));
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
        $cache->key = $token;
        $cache->expires = ($parseToken->getClaim('exp') - $parseToken->getClaim('iat')) / 60;
        $cache->minutes = config('token.refresh_ttl');
        $cache->status = 1;
        $cache->save();
    
        return $token;
    }
}