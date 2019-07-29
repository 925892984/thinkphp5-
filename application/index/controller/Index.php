<?php
namespace app\index\controller;

use think\Controller;
use think\View;

class Index extends Base
{
    public function index()
    {
        $where = [];
        if (input('?id')){
            $where = [
                'cate_id' => input('id')
            ];
        }
        $articles = model('Article')->where($where)->order('create_time','desc')->paginate(5);
        $this->assign('articles',$articles);
        return view();
    }
}
