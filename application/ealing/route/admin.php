<?php
use think\Route;
use app\ealing\controller\admin as ADMIN;

Route::get('/', ADMIN\Index::class.'@index');