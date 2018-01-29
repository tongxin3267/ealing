<?php
use think\Route;
use app\ealing\controller\admin as ADMIN;

Route::get('/', ADMIN\Main::class.'@login');
Route::get('/main', ADMIN\User::class.'@store');