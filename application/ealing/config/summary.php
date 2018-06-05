<?php
/**
* 模块栏目配置
* @date: 2018年1月24日 下午12:04:28
* @author: onep2p <324834500@qq.com>
*/

return [
    'alias' => 'ealing',//模块栏目别名
    'icon' => 'easel',//模块栏目图标
    'path' => url(app\ealing\controller\admin\Config::class.'@configs'),//模块入口地址(路由)
    
    'open' => ['config'],//默认打开的侧边一级栏目  这里必须用数组
    'active' => 'configs',//默认页面指定
    'sort' => 0,//排序
    
    'title' => '系统',
    'template' => [
        [
            'name' => '配置管理',//当没有二级的时候可以忽略，但必须在二级中填写icon，否则栏目有可能结构错误
            'alias' => 'config',//当没有二级的时候可以忽略，但必须在二级中填写icon，否则栏目有可能结构错误
            'icon' => 'ios-gear',//当没有二级的时候可以忽略，但必须在二级中填写icon，否则栏目有可能结构错误
            'submenu' => [
                ['name' => '网站配置', 'alias' => 'roles', 'icon'  => '', 'path'  => ''],
                ['name' => '存储管理', 'alias' => 'cloud', 'icon'  => '', 'path'  => ''],
                ['name' => '配置列表', 'alias' => 'configs', 'icon'  => '', 'path'  => url(app\ealing\controller\admin\Config::class.'@configs')],
            ]
        ],
        [
            'name' => '权限管理',
            'alias' => 'card',
            'icon' => 'card',
            'submenu' => [
                ['name' => '权限列表', 'alias' => 'access', 'icon'  => '', 'path'  => ''],
                ['name' => '分组授权', 'alias' => 'auth', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '模块管理',
            'alias' => 'module',
            'icon' => 'ios-grid-view',
            'submenu' => [
                ['name' => '已安装模块', 'alias' => 'lists', 'icon'  => '', 'path'  => ''],
                ['name' => '未安装模块', 'alias' => 'lists', 'icon'  => '', 'path'  => ''],
            ]
        ],
        [
            'name' => '插件管理',
            'alias' => 'addons',
            'icon' => 'ios-browsers',
            'submenu' => [
                ['name' => '已安装插件', 'alias' => 'lists', 'icon'  => '', 'path'  => ''],
                ['name' => '未安装插件', 'alias' => 'lists', 'icon'  => '', 'path'  => ''],
            ]
        ]
    ],
];