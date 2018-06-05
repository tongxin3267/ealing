<?php
use think\Route;
use app\user\controller\admin as ADMIN;

//后端路由
Route::group('user', function(){
    Route::get('/users', ADMIN\User::class.'@users');
    Route::get('/roles', ADMIN\User::class.'@roles');
});
