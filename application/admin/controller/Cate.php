<?php

namespace app\admin\controller;

use think\Db;


class Cate extends Base
{
    //栏目列表
    public function catelist()
    {
        $cates = model('Cate') ->order('sort','asc') ->paginate(10);
//        $cates = Db::table('tp_cate') ->order('sort')-> select();
//        定义一个模板字符变量
//        $viewData = [
//           'cates' => '$cates'
//        ];
        $this->assign('cates',$cates);
        return view();
    }
//    栏目添加
    public function add()
    {
        if (request()->isAjax()) {
            $data = [
              "catename" => input('post.catename'),
              "sort" => input('post.sort')
            ];
            $result = model('Cate') -> add($data);
            if($result == 1) {
//                $cates = model('Cate') ->order('sort','asc') ->paginate(1);
//                $cates = Db::table('tp_cate') ->order('sort')-> select();
//                return $cates;
                $this->success('栏目添加成功！','admin/cate/catelist');
            } else {
                $this->error($result);
            }
        }
        return view();
    }
//    排序
    public function sort()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'sort' => input('post.sort')
            ];
        }
        $result = model('Cate')->sort($data);
        if ($result == 1) {
            return $this->success('排序成功!','admin/cate/catelist');
        } else {
            return $this->error($result);
        }
    }
//    编辑
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'catename' => input('post.catename')
            ];
            $result = model('Cate')->edit($data);
            if ($result == 1) {
                return $this->success("栏目编辑成功！",'admin/cate/catelist');
            } else {
                return $this->error($result);
            }
        }
        $id = input('id');
        $cateInfo = model('Cate') -> find($id);
        $this->assign('cateInfo',$cateInfo);
        return $this->view->fetch();
    }

//    删除
    public function delete()
    {
        if (request()->isAjax()) {
            $data = input('post.id');
            $cateInfo = model('Cate')->with('article,article.comment')->find($data);
            foreach ($cateInfo['article'] as $k => $v){
                $v->together('comment')->delete();
            }
            $result = $cateInfo->together('article')->delete();
            if ($result) {
                return $this->success('删除成功!','admin/cate/catelist');
            } else {
                return $this->error($result);
            }
        }
    }

}

