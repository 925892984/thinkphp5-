<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Member extends Model
{
    //软删除
    use SoftDelete;

    //关联评论表
    public function comment()
    {
        return $this->hasMany('comment','member_id','id');
    }
    //添加会员
    public function add($data)
    {
        $validate = new \app\common\validate\Member();
        if(!$validate->scene('sceneAdd')->check($data)){
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result){
            return 1;
        } else {
            return '会员添加失败！';
        }
    }

    //编辑会员
    public function edit($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('sceneEdit')->check($data)){
            return $validate->getError();
        }
        $memberInfo =  $this->find($data['id']);
        $memberInfo->username =$data['username'];
        $memberInfo->nickname =$data['nickname'];
        $memberInfo->email =$data['email'];
        $result = $memberInfo->save();
        if ($result){
            return 1;
        } else {
            return '会员更新成功！';
        }
    }

    //注册
    public  function register($data){
        $validate = new \app\common\validate\Member();
        $result	= $validate->scene('sceneRegister')->check($data);
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

    // 登录校验
    public function  login($data)
    {
        $validate = new \app\common\validate\Member();
        $result	= $validate->scene('sceneLogin')->check($data);
        if (!$result){
            return $validate->getError();
        }
        unset($data['captcha']);
        $result = $this->where($data)->find();
        if($result){
//            检查账户是否可用,status为1可用，
            if($result['status'] != 1) {
                return '此账户被禁用';
            }
//            登陆成功后保存状态
            $sessionData = [
                'id' =>$result['id'],
                'nickname'=>$result['nickname']
            ];
            session('admin',$sessionData);
//            1表示有这个用户，用户名和密码正确
            return 1;
        }else{
            return '用户名或密码错误！';
        }
    }
}
