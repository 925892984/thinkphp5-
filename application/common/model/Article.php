<?php

namespace app\common\model;

use	traits\model\SoftDelete;
use think\Model;
use think\Db;

class Article extends Model
{
    //软删除
    use SoftDelete;

    //关联栏目表
    public function cate()
    {
        return $this->belongsTo('cate','cateid','id');
    }

    //关联评论
    public function comment()
    {
        return $this->hasMany('Comment','article_id','id');
    }

    //  文章添加
    public function add($data)
    {
        $validate = new \app\common\validate\Article();
        if (!$validate->scene('sceneAdd')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '文章添加失败！';
        }

    }

    //推荐
    public function isTop($data)
    {
        $articleInfo = $this->where('id',$data['id'])->find();
        if ($data['is_top'] == 1){
            $articleInfo->is_top = 0;
            $result = $articleInfo->save();
            if ($result){
                return 1;
            } else {
                return '取消推荐失败!';
            }
        } else {
            $articleInfo->is_top = 1;
            $result = $articleInfo->save();
            if ($result) {
                return 1;
            } else {
                return '推荐失败！';
            }
        }
    }

    //更新
    public function edit($data)
    {
        $validate = new \app\common\validate\Article();
        if(!$validate->scene('sceneEdit')->check($data)){
            return $validate->getError();
        }
        $articleInfo = $this->find($data['id']);
        $articleInfo->title = $data['title'];
        $articleInfo->tags = $data['tags'];
        $articleInfo->cateid = $data['cateid'];
        $articleInfo->desc = $data['desc'];
        $articleInfo->content = $data['content'];
        $articleInfo->is_top = $data['is_top'];
        $result = $articleInfo -> save();
        if ($result){
            return 1;
        } else {
            return '更新失败!';
        }
    }
}


