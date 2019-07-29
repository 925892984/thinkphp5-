<?php

namespace app\admin\controller;

use think\Controller;

class Admin extends Base
{
    //管理员列表
    public function adminList()
    {
        $admins = model('Admin')->order(['is_super' => 'desc','status' => 'desc','id' => 'desc'])->paginate(10);
        $this->assign('admins', $admins);
        return view();
    }

    //添加管理员
    public function add()
    {
        if(request()->isAjax()){
            $data = [
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'repassword'=>input('post.repassword'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
            $result = model('Admin')->adminAdd($data);
            if ($result == 1) {
                $this->success('添加成功!',url('admin/admin/adminList'));
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    //编辑
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'username'=>input('post.username'),
                'nickname'=>input('post.nickname'),
                'email'=>input('post.email')
            ];
            $result = model('Admin')->edit($data);
            if ($result == 1) {
                return $this->success("编辑成功！",'admin/admin/adminList');
            } else {
                return $this->error($result);
            }
        }
        $adminInfo = model('Admin')->find(input('id'));
        $this->assign('adminInfo',$adminInfo);
        return view();
    }

    //删除管理员
    public function delete()
    {
        if (request()->isAjax()) {
            $data = input('post.id');
            $adminInfo = model('Admin')->find($data);
            $result = $adminInfo->delete();
            if ($result) {
                return $this->success('删除成功!','admin/admin/adminList');
            } else {
                return $this->error($result);
            }
        }
    }

    //管理员状态
    public function status()
    {
        if (request()->isAjax()){
            $data = [
                'id' => input('post.id'),
                'status' => input('post.status') ? 0 :1
            ];
            $statusInfo = model('Admin')->find($data['id']);
            $statusInfo->status = $data['status'];
            $result = $statusInfo->save();
            if ($result){
                return $this->success('操作成功!','admin/admin/adminList');
            } else {
                return $this->error($result);
            }
        }
    }

}
