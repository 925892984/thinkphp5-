<?php

namespace app\index\controller;

use think\Controller;

class Base extends Controller
{
    //使用共享视图
    public function _initialize()
    {
        $cates = model('Cate')->order('sort','asc')->select();
        $webInfo = model('System')->find();
//        $this->assign('cates',$cates);
        //V5.0.4+ 开始，支持在任何地方使用静态方法进行模板变量赋值，例如：
        //think\View::share('name','value'); //	或者批量赋值 think\View::share(['name1'=>'value','name2'=>'value2']);

        $this->view->share(['cates'=>$cates,'webInfo'=>$webInfo]);
    }
}
