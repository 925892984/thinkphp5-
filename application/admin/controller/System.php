<?php

namespace app\admin\controller;

use think\Controller;

class System extends Base
{
    //系统设置
    public function set()
    {
        if (request()->isAjax()){
            $data = [
              'id' => input('post.id'),
              'webname' => input('post.webname'),
              'copyright' => input('post.copyright')
            ];
            $result = model('System')->set($data);
            if ($result == 1){
                return $this->success('修改成功！','admin/system/set');
            } else {
                return $this->error($result);
            }
        }
        $webInfo = model('System')->find();
        $this->assign('webInfo',$webInfo);
        return view();
    }
}
