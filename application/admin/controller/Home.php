<?php

namespace app\admin\controller;

class Home extends Base
{
    //后台首页
    public function index()
    {
        return view('home/index');
    }

//    用户退出
    public function loginout()
    {
        session(null);
        if (session('?admin.id')) {
            return $this->error('退出失败！');
        } else {
            $this->success('退出成功!','admin/index/login');
        }

    }
}
