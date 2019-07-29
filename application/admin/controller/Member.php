<?php

namespace app\admin\controller;

class Member extends Base
{
    //会员列表
    public function memberList()
    {
        $members = model('Member')->order('id')->paginate(10);
        $this->assign('members',$members);
        return view();
    }

    //会员添加
    public function add()
    {
        if (request()->isAjax()){
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email')
            ];
            $result = model('Member')->add($data);
            if ($result == 1){
                return $this->success('会员添加成功！','admin/member/memberList');
            } else {
                return $this->error($result);
            }
        }
        return view();
    }

    //编辑
    public function edit()
    {
        if (request()->isAjax()){
            $data = [
                'id' => input('post.id'),
                'username' => input('post.username'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email')
            ];
            $result = model('Member')->edit($data);
            if ($result == 1){
                return $this->success('会员更新成功！','admin/member/memberList');
            } else {
                return $this->error($result);
            }
        }


        $memberInfo = model('Member')->find(input('id'));
        $this->assign('memberInfo',$memberInfo);

        return view();
    }

    //删除
    public function delete()
    {
        if (request()->isAjax()) {
            $data = input('post.id');
            $memberInfo = model('Member')->find($data);
            $result = $memberInfo->delete();
            if ($result) {
                return $this->success('删除成功!','admin/member/memberList');
            } else {
                return $this->error($result);
            }
        }
    }
}
