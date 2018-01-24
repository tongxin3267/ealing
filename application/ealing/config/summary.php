<?php
/**
* 模块栏目配置
* @date: 2018年1月24日 下午12:04:28
* @author: onep2p <324834500@qq.com>
*/

return [
    'open' => 'user',//默认打开的侧边一级栏目
    'active' => 'user-list',//默认页面指定
    'theme' => 'light',//主题（针对iview的）
    'title' => '系统',//面包屑一级名称
    'subTitle' => '用户管理',//面包屑二级名称
    'actionTitle' => '用户列表',//面包屑三级名称
    'template' => [
        [
            'name' => '用户管理',
            'alias' => 'user',
            'icon' => 'person-stalker',
            'submenu' => [
                ['name' => '用户列表', 'alias' => 'user-list', 'icon'  => '', 'path'  => ''],
                ['name' => '用户角色', 'alias' => 'user-role', 'icon'  => '', 'path'  => ''],
                ['name' => '权限列表', 'alias' => 'access-list', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '钱包管理',
            'alias' => '',
            'icon' => 'cash',
            'submenu' => [
                ['name' => '充值列表', 'alias' => '', 'icon'  => '', 'path'  => ''],
                ['name' => '提现列表', 'alias' => '', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '身份管理',
            'alias' => '',
            'icon' => 'card',
            'submenu' => [
                ['name' => '标签管理', 'alias' => '', 'icon'  => '', 'path'  => ''],
                ['name' => '身份认证', 'alias' => '', 'icon'  => '', 'path'  => ''],
            ]
        ]
    ],
];