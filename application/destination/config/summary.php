<?php
return [
    'alias' => 'destination',//模块栏目别名
    'icon'  => 'merge',//模块栏目图标
    'path' => url(app\destination\controller\admin\Destination::class.'@config'),//模块入口地址(路由)
    
    'open' => ['destination'],//默认打开的侧边一级栏目  必须同控制器名
    'active' => 'config',//默认页面指定 必须同操作名
    'sort' => 1,//排序
    
    'title' => '目的地',//面包屑一级名称
    'subTitle' => '目的地管理',//面包屑二级名称
    'actionTitle' => '目的地设置',//面包屑三级名称

    'template' => [
        [
            'name' => '目的地管理',
            'alias' => 'destination',
            'icon' => 'steam',
            'submenu' => [
                ['name' => '目的地设置', 'alias' => 'config', 'icon'  => '', 'path'  => ''],
            ]
        ]
    ],    
];