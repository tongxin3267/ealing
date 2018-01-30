<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/11
 */
namespace app\ealing\controller\admin;

use app\ealing\controller\admin\builder\BackstageListBuilder;

class User{
    public function store(){
        $builder = new BackstageListBuilder();

        $list = [
            ['id'=>1,'title'=>'逸秋', 'status'=>1],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0]
        ];

        $builder->title("用户列表 - 用户管理")
            ->buttonNew(url('app\ealing\controller\admin\User@main'), '新增')
            ->buttonEnable()
            ->buttonDisable()
            ->buttonDelete()
            ->buttonRestore()
            ->keySelection()
            ->keyIndex()
            ->keyText('title', '名称')
            ->keyMap('status', '状态', [1=>'启用', 0=>'禁用'])
            ->keyEditAction(url('app\ealing\controller\admin\User@Edit'))
            ->keyDelAction(url('app\ealing\controller\admin\User@Del'))
            ->data($list);
        
        return $builder->show();
    }
}