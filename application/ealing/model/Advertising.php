<?php
/**
* 广告数据模型
* @date: 2017年12月4日 下午2:09:30
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class Advertising extends BaseModel
{
    protected $fillable = ['space_id', 'type', 'title', 'data', 'sort'];

    protected $casts = [
        'data' => 'array',
    ];

    public function space()
    {
        return $this->belongsTo('AdvertisingSpace');
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
    
    /**
    * 指定多个广告位的条件
    * @date: 2017年12月8日 下午5:08:29
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeInSpace($query, $space)
    {
        return $query->where('space_id', 'IN', $space);
    }
}