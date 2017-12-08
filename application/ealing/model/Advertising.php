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
    
    /**
    * 指定广告位条件
    * @date: 2017年12月8日 下午4:32:48
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeBySpace($query, $space_id)
    {
        return $query->where('space_id', $space_id);
    }    
}