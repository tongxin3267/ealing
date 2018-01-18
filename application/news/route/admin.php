<?php
use think\Route;


//后端路由
Route::group('news', function(){
    Route::get('/', function(){
        return 'newsadmin';
    });
});