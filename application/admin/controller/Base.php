<?php

namespace app\admin\controller;

use think\Controller;

//Base是定义的一个基础控制器

class Base extends Controller
{
//导航守卫：防止未登录状态下，进入后台页面
    public function _initialize()
    {
        if (!session('?admin.id')) {
            $this->redirect('admin/index/login');
        }
    }
}
