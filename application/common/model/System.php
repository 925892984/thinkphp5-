<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class System extends Model
{
    //软删除
    use SoftDelete;

    //网站信息更新
    public function set($data)
    {
        $validate = new \app\common\validate\System();
        if (!$validate->scene('sceneSet')->check($data)){
            return $validate->getError();
        }
        $webInfo = $this->find($data['id']);
        $webInfo->webname = $data['webname'];
        $webInfo->copyright = $data['copyright'];
        $result = $webInfo->save();
        if ($result){
            return 1;
        } else {
            return '修改失败！';
        }
    }
}
