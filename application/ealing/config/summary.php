<?php
/**
* 模块栏目配置
* @date: 2018年1月24日 下午12:04:28
* @author: onep2p <324834500@qq.com>
*/

return [
    'alias' => 'ealing',//模块栏目别名
    'icon' => 'easel',//模块栏目图标
    'path' => url(app\ealing\controller\admin\User::class.'@users'),//模块入口地址(路由)
    
    'open' => ['user'],//默认打开的侧边一级栏目  这里必须用数组
    'active' => 'users',//默认页面指定
    
    'title' => '系统',
    'template' => [
        [
            'name' => '用户管理',//当没有二级的时候可以忽略，但必须在二级中填写icon，否则栏目有可能结构错误
            'alias' => 'user',//当没有二级的时候可以忽略，但必须在二级中填写icon，否则栏目有可能结构错误
            'icon' => 'person-stalker',//当没有二级的时候可以忽略，但必须在二级中填写icon，否则栏目有可能结构错误
            'submenu' => [
                ['name' => '用户列表', 'alias' => 'users', 'icon'  => '', 'path'  => url(app\ealing\controller\admin\User::class.'@users')],
                ['name' => '用户角色', 'alias' => 'role', 'icon'  => '', 'path'  => ''],
                ['name' => '权限列表', 'alias' => 'access', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '钱包管理',
            'alias' => 'cash',
            'icon' => 'cash',
            'submenu' => [
                ['name' => '充值列表', 'alias' => 'recharge', 'icon'  => '', 'path'  => ''],
                ['name' => '提现列表', 'alias' => 'cash', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '身份管理',
            'alias' => 'card',
            'icon' => 'card',
            'submenu' => [
                ['name' => '标签管理', 'alias' => 'tag', 'icon'  => '', 'path'  => ''],
                ['name' => '身份认证', 'alias' => 'auth', 'icon'  => '', 'path'  => ''],
            ]
        ]
    ],
];