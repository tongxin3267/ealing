<?php
/**
* 标签分类模型
* @date: 2017年12月13日 下午1:40:54
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class TagCategorie extends BaseModel
{
    /**
     * 用于序列化的应隐藏的属性
     * @var unknown
     */
    protected $hidden = ['created_at', 'updated_at'];
    
    /**
     * 标签关联
     */
    public function tags()
    {
        return $this->hasMany('Tags', 'tag_category_id', 'id')->order('weight desc');
    }
}