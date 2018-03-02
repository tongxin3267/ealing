<?php
/**
* 钱包模型相关可复用类
* @date: 2018年3月2日 下午2:27:56
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model\relations;

use app\ealing\model\Wallets;

trait UserHasWallet
{
    /**
    * Bootstrap the trait.
    * @date: 2018年3月2日 下午2:43:43
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public static function bootUserHasWallet()
    {
        // 用户创建后事件
        static::created(function ($user) {
            $wallet = Wallet::create([
                'user_id' => $user->id,
                'balance' => 0
            ]);
            
            if ($wallet === false) return false;
        });
        
        // 用户删除后事件
        static::deleted(function ($user) {
            $user->wallet()->delete();
        });
    }
    
    /**
    * User wallet.
    * @date: 2018年3月2日 下午2:44:28
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function wallet()
    {
        return $this->hasOne(Wallets::class, 'user_id', 'id');
    }
}