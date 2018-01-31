<?php
use think\Route;
use app\ealing\controller\admin as ADMIN;

Route::get('/', ADMIN\Main::class.'@login');
Route::get('/main', ADMIN\Main::class.'@store');
Route::get('/users', ADMIN\User::class.'@users');
Route::get('/roles', ADMIN\User::class.'@roles');