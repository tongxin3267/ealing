<?php
/**
 * Created by PhpStorm.
 * User: pengxuancom@163.com
 * Date: 2018/1/11
 */
namespace app\user\controller\admin;

use app\ealing\controller\admin\BaseController;
use app\ealing\controller\admin\builder\BackstageListBuilder;

class User extends BaseController{
    /**
    * 用户列表
    * @date: 2018年1月31日 下午2:04:18
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function users(){
        $builder = new BackstageListBuilder();

        $list = [
            ['id'=>1,'title'=>'逸秋', 'status'=>1, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
            ['id'=>2,'title'=>'逸秋1', 'status'=>0, 'time'=>1517293857],
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
            ->keyLinkByFlag('title', '名称', url(User::class.'@users'))
            ->keyMap('status', '状态', [1=>'启用', 0=>'禁用'])
            ->keyTime('time', '创建时间', ['format'=>'Y-m-d H:i:s'])
            ->keyEditAction(url(User::class.'@Edit'))
            ->keyDelAction(url(User::class.'@Del'))
            ->data($list);
        
        return $builder->show();
    }
    
    /**
    * 角色列表
    * @date: 2018年1月31日 下午2:04:28
    * @author: onep2p <324834500@qq.com>
    * @param: variable
    * @return:
    */
    public function roles(){
        $builder = new BackstageListBuilder();
        
        $list = [];
        
        $builder->title("用户角色 - 用户管理")
        ->buttonNew(url(User::class.'@main'), '新增')
        ->buttonDelete()
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