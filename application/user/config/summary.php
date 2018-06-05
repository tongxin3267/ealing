<?php
return [
    'alias' => 'user',//模块栏目别名
    'icon'  => 'person',//模块栏目图标
    'path' => url(app\user\controller\admin\User::class.'@users'),//模块入口地址(路由)
    
    'open' => ['user'],//默认打开的侧边一级栏目  必须同控制器名
    'active' => 'users',//默认页面指定 必须同操作名
    'sort' => 0,//排序
    
    'title' => '用户',//面包屑一级名称
    'subTitle' => '用户管理',//面包屑二级名称
    'actionTitle' => '用户列表',//面包屑三级名称
    'template' => [
        [
            'name' => '用户管理',
            'alias' => 'user',
            'icon' => 'ios-person',
            'submenu' => [
                ['name' => '用户列表', 'alias' => 'store', 'icon'  => '', 'path'  => ''],
                ['name' => '用户标签', 'alias' => 'user-role', 'icon'  => '', 'path'  => ''],
                ['name' => '用户认证', 'alias' => 'access-list', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '订单管理',
            'alias' => 'cate',
            'icon' => 'ios-color-filter',
            'submenu' => [
                ['name' => '订单列表', 'alias' => '', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '支付管理',
            'alias' => 'cash',
            'icon' => 'cash',
            'submenu' => [
                ['name' => '充值列表', 'alias' => 'recharge', 'icon'  => '', 'path'  => ''],
                ['name' => '提现列表', 'alias' => 'cash', 'icon'  => '', 'path'  => ''],
            ]
        ]
    ],
];