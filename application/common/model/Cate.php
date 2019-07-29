<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;
use think\Db;

class Cate extends Model
{
    //软删除
    use SoftDelete;

    //关联文章表
    public function article()
    {
        return $this->hasMany('Article','cateid','id');
    }

//添加栏目
    public function add($data){
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('sceneAdd')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '栏目添加失败！';
        }
    }

//    排序
    public function sort($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('sceneSort')->check($data)) {
            return $validate->getError();
        }
        $cateInfo =  $this->find($data['id']);
        $cateInfo -> sort = $data['sort'];
        $result = $cateInfo->save();
        if ($result) {
            return 1;
        } else {
            return '排序失败！';
        }
    }

//    编辑
    public function edit($data)
    {
        $validate = new \app\common\validate\Admin();
        if (!$validate->scene('sceneEdit')->check($data)) {
            return $validate->getError();
        }
        $cateInfo = $this->find($data['id']);
        $cateInfo->catename = $data['catename'];
        $result = $cateInfo -> save();
        if ($result) {
            return 1;
        } else {
            return '编辑失败！';
        }
    }

//    删除
    public function deleteCate($data)
    {
//        $cateInfo = $this->find($data);
        $result = Db::name('blog')->where('id',$data)->delete();
        if ($result) {
            return 1;
        } else {
            return "删除失败！";
        }
    }
}
