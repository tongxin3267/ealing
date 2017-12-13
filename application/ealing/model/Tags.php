<?php
/**
* 标签模型
* @date: 2017年12月13日 下午1:40:54
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class Tags extends BaseModel
{
    /**
     * 用于序列化的应隐藏的属性
     * @var unknown
     */
    protected $hidden = ['created_at', 'updated_at', 'pivot'];
    
    /**
     * 分类关联
     */
    public function category()
    {
        return $this->hasOne('TagCategorie', 'id', 'tag_category_id');
    }
    
    /**
     * 统计使用了多少次
     */
    public function taggable()
    {
        return $this->hasMany('Taggable', 'tag_id', 'id');
    }    
}