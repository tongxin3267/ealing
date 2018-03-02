<?php
/**
* 钱包模型
* @date: 2018年3月2日 下午2:34:44
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class Wallets extends BaseModel
{
    protected $fillable = ['user_id', 'balance'];  
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}