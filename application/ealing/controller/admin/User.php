<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/11
 */
namespace app\ealing\controller\admin;

use app\ealing\controller\admin\builder\BackstageListBuilder;

class User extends BaseController{    
    public function users(){
        $builder = new BackstageListBuilder();

        $list = [
            ['id'=>1,'title'=>'逸秋', 'status'=>1, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857]
        ];
        
        $builder->title("用户列表 - 用户管理")
            ->buttonNew(url(User::class.'@main'), '新增')
            ->buttonEnable()
            ->buttonDisable()
            ->buttonDelete()
            ->buttonRestore()
            ->keySelection()
            ->keyIndex()
            ->keyText('title', '名称')
            ->keyMap('status', '状态', [1=>'启用', 0=>'禁用'])
            ->keyTime('time', '创建时间', ['format'=>'Y-m-d H:i:s'])
            ->keyLinkByFlag('id', '查看用户信息', url(User::class.'@store'))
            ->keyEditAction(url(User::class.'@Edit'))
            ->keyDelAction(url(User::class.'@Del'))
            ->data($list);
        
        return $builder->show();
    }
}