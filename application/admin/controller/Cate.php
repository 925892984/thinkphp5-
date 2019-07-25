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
}
