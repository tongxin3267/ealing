<?php
/**
* 公共配置模型
* @date: 2017年12月4日 上午11:33:41
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class CommonConfigs extends BaseModel
{
    /**
    * 指定空间条件
    * @date: 2017年12月8日 下午2:43:12
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeByNamespace($query, $namespace)
    {
        return $query->where('namespace', $namespace);
    }
    
    /**
    * 指定名称条件
    * @date: 2017年12月8日 下午2:43:47
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeByName($query, $name)
    {
        return $query->where('name', $name);
    }
}