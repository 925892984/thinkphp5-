<?php
namespace app\index\controller;

use think\Controller;
use think\View;

class Index extends Base
{
    //前端首页
    public function index()
    {
        $where = [];
        $catename = null;
        if (input('?id')){
            $where = [
                'cateid' => input('id')
            ];
            $catename = model('Cate')->where('id',input('id'))->value('catename');
        }
        $articles = model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $this->assign('articles',$articles);
        $this->assign('catename',$catename);
        return view();
    }

    //注册

    public function register()
    {
        if(request()->isAjax()){
            $data = [
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'conpass'=>input('post.conpass'),
                'email'=>input('post.email'),
                'nickname' => input('post.nickname'),
                'captcha' => input('post.captcha')
            ];
            $result = model('Member')->register($data);
            if ($result == 1) {
                mailto($data['email'],'注册管理员账户成功！','注册管理员账户成功!');
                $this->success('注册成功!',url('index/index/login'));
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    //登陆
    public function login()
    {
        if (request()->isAjax()){
            $data = [
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'captcha' =>input('post.captcha')
            ];
//去common中找model，common中放公共model，助手函数model(),首先会去相应控制器（即admin）中找model，
//如果没有，就去commom中寻找
//          new \app\common\model\Admin();
            $result = model('Member')->login($data);
            if($result == 1){
                return $this->success('登陆成功','index/index/index');
            }else{
                return $this->error($result);
            }
        }
        return view();
    }

//   用户退出
    public function loginout()
    {
        session(null);
        if (session('?admin.id')) {
            return $this->error('退出失败！');
        } else {
            $this->success('退出成功!','index/index/login');
        }
    }
}
