<?php
/**
* 公共配置类
* @date: 2017年12月4日 上午11:33:41
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\services;

use app\ealing\model\CommonConfigs;

class CommonConfig{
    /**
    * 根据scope获取配置数据
    * @date: 2017年12月4日 上午11:38:59
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeByNamespace($namespace)
    {
        $result = CommonConfigs::all(function($query)use($namespace){
            $query->where('namespace', $namespace);
        });
        
        return $result;
    }
    
    /**
    * 获取指定配置项
    * @date: 2017年12月4日 上午11:40:08
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function scopeByName($name)
    {
        $result = CommonConfigs::get(function($query)use($name){
            $query->where('name', $name);
        });
        
        return $result;
    }
    
    /**
    * 设置要更新的keys数据
    * @date: 2017年12月4日 上午11:41:26
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function setKeysForSaveQuery()
    {
        foreach ($this->getKeyName() as $key) {
            $query->where($key, '=', $this->original[$key] ?? $this->getAttribute($key));
        }
    
        return $query;
    }
}