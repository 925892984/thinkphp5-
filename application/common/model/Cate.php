<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Cate extends Model
{
    //软删除
    use SoftDelete;
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
}
