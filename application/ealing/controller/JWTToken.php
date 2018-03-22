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
        $signerKey = Env::get('APP_KEY');//默认key
        
        return $this->token(
           (string) (new Builder())
                ->setIssuer(Env::get('APP_URL'))
                ->setAudience(Env::get('APP_URL'))
                ->setId($signerKey, true)
                ->setIssuedAt($_SERVER['REQUEST_TIME'])
                ->setNotBefore($_SERVER['REQUEST_TIME'] + 60)
                ->setExpiration($_SERVER['REQUEST_TIME'] + config('token.ttl')*60)
                ->set('ttl', config('token.refresh_ttl'))
                ->set('uid', $user->id)
                ->getToken()
        );
    }
    
    /**
     * 刷新token
     * @date: 2018年2月28日 下午4:53:56
     * @author: onep2p <324834500@qq.com>
     * @param: variable
     * @return: array
     */
    public function refreshToken($token)
    {
        //DOTO: 刷新之前先确认token的存在情况
        $validation = $this->validation($token);
        
        if($validation === true) {
            return $token;
        } else if($validation === false) {
            $signerKey = Env::get('APP_KEY');//默认key
            
            return 1;
//             return $this->token(
//                 (string) (new Builder())
//                 ->setIssuer(Env::get('APP_URL'))
//                 ->setAudience(Env::get('APP_URL'))
//                 ->setId($signerKey, true)
//                 ->setIssuedAt($_SERVER['REQUEST_TIME'])
//                 ->setNotBefore($_SERVER['REQUEST_TIME'] + 60)
//                 ->setExpiration($_SERVER['REQUEST_TIME'] + config('token.ttl')*60)
//                 ->set('ttl', config('token.refresh_ttl'))
//                 ->set('uid', $user->id)
//                 ->getToken()
//             );
        } else {
            return $validation;
        }
        
        //DOTO: 验证token是否正确，且是否在刷新过期时间外
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
                return false;
            }else{
                return true;
            }
        }catch(\Exception $e){
            return $e->getMessage();
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
        $uid = $parseToken->getClaim('uid');
        
        //禁止掉之前的token
        $cache->update(['status'=>0], ['user_id'=>$uid]);
        
        //新增可用的token
        $cache->user_id = $uid;
        $cache->values = $token;
        $cache->expires = ($parseToken->getClaim('exp') - $parseToken->getClaim('iat')) / 60;
        $cache->minutes = config('token.refresh_ttl');
        $cache->status = 1;
        $cache->save();
    
        return $token;
    }
}