<?php

namespace app\admin\controller;


class Comment extends Base
{
    //评论列表
    public function commentList()
    {
        $comments = model('Comment')->with('article,member')->order('create_time','desc')->paginate(10);
        $this->assign('comments',$comments);
        return view();
    }

    //删除
    public function delete()
    {
        if (request()->isAjax()) {
            $data = input('post.id');
            $commentInfo = model('Comment')->find($data);
            $result = $commentInfo->delete();
            if ($result) {
                return $this->success('删除成功!','admin/comment/commentList');
            } else {
                return $this->error($result);
            }
        }
    }
}
