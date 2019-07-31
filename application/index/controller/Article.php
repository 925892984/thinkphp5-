<?php

namespace app\index\controller;

use think\View;

class Article extends Base
{
    //文章页
    public function info()
    {
        $articleInfo = model('Article')->with('comment,comment.member')->find(input('id'));
        //自增或自减一个字段的值
        //setInc/setDec	如不加第二个参数，默认值为1
        $articleInfo->setInc('click');
        $this->assign('articleInfo',$articleInfo);
        return view();
    }
}
