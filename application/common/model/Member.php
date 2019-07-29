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
}
