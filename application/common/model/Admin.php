<?php

namespace app\common\model;
//use think\model\concern\SoftDelete;
use	traits\model\SoftDelete;
use think\Model;

class Admin extends Model
{
    //软删除
    use SoftDelete;
   // 登录校验
    public function  login($data)
    {
        $validate = new \app\common\validate\Admin();
        $result	= $validate->scene('sceneLogin')->check($data);
//        if(!$validate->scene('login')->check($data)){
        if (!$result){
            return $validate->getError();
        }
        $result = $this->where($data)->find();
        if($result){
//            检查账户是否可用,status为1可用，
            if($result['status'] != 1) {
                return '此账户被禁用';
            }
//            登陆成功后保存状态
            $sessionData = [
                'id' =>$result['id'],
                'nickname'=>$result['nickname'],
                'is_super' => $result['is_super']
            ];
            session('admin',$sessionData);
//            1表示有这个用户，用户名和密码正确
            return 1;
        }else{
            return '用户名或密码错误！';
        }
    }
    //注册
    public  function register($data){
        $validate = new \app\common\validate\Admin();
        $result	= $validate->scene('sceneRegister')->check($data);
//        if(!$validate->scene('register')->check($data)) {
        if (!$result) {
            return $validate->getError();
        }
        $result = $this->allowField(true) -> save($data);
        if($result) {
            return 1;
        } else {
            return '注册失败!';
        }

    }
//   重置密码
    public function add($data)
    {
        $validata = new \app\common\validate\Admin();
        if(!$validata->scene('$sceneReset')->check($data)) {
            $validata->getError();
        }
        if ($data['code'] != session('code')) {
            return '验证码不正确!';
        }
        $adminInfo = $this->where('email',$data['email'])->find();
        $password = mt_rand(10000,99999);
        $adminInfo -> password = $password;
        $result = $adminInfo->save();
        if($result) {
            $content = '恭喜您，密码重置成功!<br>用户名:'.$adminInfo['username'].'<br>.新密码:'
                .$password;
            mailto($data['email'],'密码重置成功！',$content);
            return 1;
        } else {
            return '密码重置失败！';
        }
    }

    //添加管理员
    public  function adminAdd($data){
        $validate = new \app\common\validate\Admin();
        $result	= $validate->scene('sceneRegister')->check($data);
        if (!$result) {
            return $validate->getError();
        }
        $result = $this->allowField(true) -> save($data);
        if($result) {
            return 1;
        } else {
            return '添加失败!';
        }

    }

    //更新管理员信息
    public function edit($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('sceneAdminEdit')->check($data)) {
            return $validate->getError();
        }
        $adminInfo = $this->find($data['id']);
        $adminInfo->nickname = $data['nickname'];
        $adminInfo->username = $data['username'];
        $adminInfo->email = $data['email'];
        $result = $adminInfo -> save();
        if ($result) {
            return 1;
        } else {
            return '编辑失败！';
        }
    }
}


