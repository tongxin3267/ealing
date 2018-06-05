<?php
use think\Route;
use app\ealing\controller\admin as ADMIN;

Route::rule('/', ADMIN\Main::class.'@login', 'GET|POST');
Route::get('/main', ADMIN\Main::class.'@store');
Route::get('/configs', ADMIN\Config::class.'@configs');