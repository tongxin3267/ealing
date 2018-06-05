<?php
use think\Route;
use app\destination\controller\admin as ADMIN;

//后端路由
Route::group('destination', function(){
    Route::get('/config', ADMIN\Destination::class.'@config');
});

