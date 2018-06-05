<?php
/**
* 目的地控制器
* @date: 2018年5月23日 下午3:01:29
* @author: onep2p <324834500@qq.com>
*/
namespace app\destination\controller\admin;

use app\ealing\controller\admin\BaseController;
use app\ealing\controller\admin\builder\BackstageListBuilder;

class Destination extends BaseController
{
    public function config(){
        $builder = new BackstageListBuilder();
        return $builder->show();
    }
}