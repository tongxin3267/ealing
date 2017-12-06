<?php
/**
* 广告数据模型
* @date: 2017年12月4日 下午2:09:30
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

use think\Model;

class Advertising extends Model
{
    protected $fillable = ['space_id', 'type', 'title', 'data', 'sort'];

    protected $casts = [
        'data' => 'array',
    ];

    public function space()
    {
        return $this->belongsTo(AdvertisingSpace::class);
    }
}