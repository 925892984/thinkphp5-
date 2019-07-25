<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +--------------------------------------------------------------------
use think\Route;

//Route::rule('/','admin/index/login');
Route::group('admin',function (){
    Route::rule('/','admin/index/login','get|post');
    Route::rule('register','admin/index/register','get|post');
    Route::rule('forget','admin/index/forget','get|post');
    Route::rule('reset','admin/index/reset','post');
    Route::rule('index','admin/home/index','get|post');
    Route::rule("loginout",'admin/home/loginout','post');
    Route::rule('catelist','admin/cate/catelist','get|post');
    Route::rule('cateadd','admin/cate/add','get|post');
});