<?php
namespace app\admin\controller;

use think\Controller;

class Index extends  Controller
{
//控制器初始化
//如果你的控制器类继承了 \think\Controller 类的话，可以定义控制器初始化方法 _initialize ，在 该控制器的方法调用之前首先执行。
//重定向
//\think\Controller 类的 redirect 方法可以实现页面的重定向功能。

//    登陆过滤：即账户已登陆时，再次登陆时，直接进入后台
    public function _initialize()
    {
       if (session('?admin.id')) {
           $this->redirect('admin/home/index');
        }
    }

//    后台登陆
    public function login()
    {
//        return $this->view();
        if (request()->isAjax()){
            //接收数据，input()可接受数据
            $data = [
                'username'=>input('post.username'),
                'password'=>input('post.password')
            ];
//去common中找model，common中放公共model，助手函数model(),首先会去相应控制器（即admin）中找model，
//如果没有，就去commom中寻找
//          new \app\common\model\Admin();
            $result = model('Admin')->login($data);
            if($result == 1){
                return $this->success('登陆成功','admin/home/index');
            }else{
                return $this->error($result);
            }
//            return $data;
        }
        return view();
    }
//注册账号
    public function register()
    {
        if(request()->isAjax()){
            $data = [
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'repassword'=>input('post.repassword'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
         $result = model('Admin')->register($data);
         if ($result == 1) {
             mailto($data['email'],'注册管理员账户成功！','注册管理员账户成功!');
             $this->success('注册成功!',url('admin/index/login'));
         } else {
             $this->error($result);
         }
        }
        return view();
    }

//    忘记密码
    public  function forget()
    {
        if(request()->isAjax()){
            $code = mt_rand(1000,9999);
            session('code',$code);
//            $data = [
//                'email'=>input('post.email')
//            ];
            $result = mailto(input('post.email'),'重置密码验证码','你的密码验证码是:'.$code);
            if($result){
                $this->success('验证码发送成功！');
            } else {
                $this->error('验证码发送失败!') ;
            }
        }
        return view();
    }
//    重置密码  发送验证码
    public function reset()
    {
        if(request()->isAjax()){
            $data = [
                'code' => input('post.code'),
                'email' => input('post.email')
            ];
            $result = model('Admin') ->reset($data);
            if ($result == 1) {
                return $this->success('密码重置成功,请去邮箱查看新密码！','admin/index/login');
                return 1;
            } else {
                $this->error($result);
            }
        }
    }
}

