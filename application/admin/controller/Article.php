<?php

namespace app\admin\controller;

class Article extends Base
{
    //文章列表
    public function articleList()
    {
//        枚举数据类型的大小比较关系，是根据枚举顺序来的，与实际关系无关
        //with()关联预载入
        $articleInfo = model('Article')->with('cate')->order(['is_top'=>'desc','create_time'=>'desc'])->paginate(10);
        $this->assign('articleInfo',$articleInfo);
        return view();
    }

    //    文章添加
    public function add()
    {
        if (request()->isAjax()) {
            $data = [
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top',0),
                'cateid' => input('post.cateid'),
                'desc' => input('post.desc'),
                'content' => input('post.content')
            ];
            $result = model('Article')->add($data);
            if($result ==1 ) {
                return $this->success('文章添加成功！','admin/article/articleList');
            } else {
                return $this->error($result);
            }
        }
        $articleInfo = model('Cate')->select();
        $this->assign('cateInfo',$articleInfo);
        return view();
    }

    //推荐
    public function isTop()
    {
        if (request()->isAjax()){
            $data = [
                'id' => input('post.id'),
                'is_top' => input('post.is_top')
            ];
            $result = model('Article')->isTop($data);
            if ($result == 1){
                return $this->success('操作成功!','admin/article/articleList');
            } else {
                return $this->error($result);
            }
        }
    }

    //编辑
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' =>input('post.id'),
                'title' => input('post.title'),
                'tags' => input('post.tags'),
                'is_top' => input('post.is_top',0),
                'cateid' => input('post.cateid'),
                'desc' => input('post.desc'),
                'content' => input('post.content')
            ];
            $result = model('Article')->edit($data);
            if ($result == 1) {
                return $this->success('文章更新成功！','admin/article/articleList');
            } else {
                return $this->error($result);
            }
        }
        $articleInfo = model('Article')->find(input('id'));
        $cates = model('Cate')->select();
        $this->assign('cates',$cates);
        $this->assign('articleInfo',$articleInfo);
        return view();
    }

    //删除
    public function delete()
    {
        if (request()->isAjax()) {
            $data = input('post.id');
            $articleInfo = model('Article')->find($data);
            $result = $articleInfo->delete();
            if ($result) {
                return $this->success('删除成功!','admin/article/articleList');
            } else {
                return $this->error($result);
            }
        }
    }
}
