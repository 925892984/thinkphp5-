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
    Route::rule('sort','admin/cate/sort','post');
    Route::rule('edit/[:id]','admin/cate/edit','get|post');
    Route::rule('delete','admin/cate/delete','post');
    Route::rule('articleList','admin/article/articleList','get|post');
    Route::rule('articleAdd','admin/article/add','get|post');
    Route::rule('isTop','admin/article/isTop','post');
    Route::rule('articleEdit/[:id]','admin/article/edit','get|post');
    Route::rule('articleDelete','admin/article/delete','post');
    Route::rule('memberList','admin/member/memberList','get');
    Route::rule('memberAdd','admin/member/add','get|post');
    Route::rule('memberEdit/[:id]','admin/member/edit','get|post');
    Route::rule('memberDelete','admin/member/delete','post');
    Route::rule('adminList','admin/admin/adminList','get');
    Route::rule('adminadd','admin/admin/add','get|post');
    Route::rule('adminEdit/[:id]','admin/admin/edit','get|post');
    Route::rule('adminDelete','admin/admin/delete','get|post');
    Route::rule('adminStatus','admin/admin/status','post');
});
