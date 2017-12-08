<?php
/**
* 区域模型
* @date: 2017年12月8日 上午8:33:49
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

use think\Model;

class Area extends Model
{
    /**
    * 根据父级获取子地区
    * @date: 2017年12月8日 上午8:34:42
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeByPid($query, $pid)
    {
        return $query->where('pid', $pid);
    }
    
    /**
    * 父地区
    * @date: 2017年12月8日 上午8:34:58
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function parent()
    {
        return $this->hasOne(__CLASS__, 'id', 'pid');
    }
    
    /**
    * 子地区
    * @date: 2017年12月8日 上午8:35:22
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function items()
    {
        return $this->hasMany(__CLASS__, 'pid');
    }    
}