<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/11
 */
namespace app\ealing\controller\admin;

use app\ealing\controller\admin\builder\BackstageListBuilder;

class Index extends Backstage{

    public function index(){

        $builder = new BackstageListBuilder();

        $list = [];

        $builder->title("测试")
            ->buttonNew(url('add'))
            ->setSearchPostUrl(url('index'))
            ->searchText('','title','text',"关键词")
            ->keyText('id',lang('_ID_'))
            ->keyText('title',"名称")
            ->data($list);
        return $builder->show();
    }
}