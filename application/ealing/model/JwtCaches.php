<?php
/**
* token模型类
* @date: 2017年12月12日 下午4:19:10
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class JwtCaches extends BaseModel
{
    protected $autoWriteTimestamp = 'timestamp';
    
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
}