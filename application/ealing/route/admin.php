<?php
use think\Route;
use app\ealing\controller\admin as ADMIN;

Route::rule('/', ADMIN\Main::class.'@login', 'GET|POST');
Route::get('/main', ADMIN\Main::class.'@store');
Route::get('/users', ADMIN\User::class.'@users');
Route::get('/roles', ADMIN\User::class.'@roles');