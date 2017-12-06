<?php
/**
* 广告位置模型
* @date: 2017年12月4日 下午2:02:28
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

use think\Model;

class AdvertisingSpace extends Model
{
    protected $fillable = ['channel', 'space', 'alias', 'allow_type', 'format', 'rule', 'message'];

    protected $casts = [
        'format' => 'array',
        'rule' => 'array',
        'message' => 'array',
    ];

    public function advertising()
    {
        return $this->hasMany(Advertising::class, 'space_id');
    }
}