<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Comment extends Model
{
    //软删除
    use SoftDelete;

    //关联文章
    public function article()
    {
        return $this->belongsTo('article','article_id','id');
    }

    //关联会员
    public function member()
    {
        return $this->belongsTo('member','member_id','id');
    }

}
