<?php
/**
* 积分昵称模型【金币,豆子,贝壳...	】
* @date: 2017年12月4日 下午3:20:07
* @author: onep2p <324834500@qq.com>
*/
namespace app\ealing\model;

class GoldType extends BaseModel
{
    public $fillable = ['name', 'unit', 'status'];
}