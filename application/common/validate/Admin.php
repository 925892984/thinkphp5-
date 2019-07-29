<?php


namespace app\common\validate;

use think\Validate;

class Admin extends  Validate
{
//    通用验证
    protected $rule = [
    'username|管理员账户' => 'require',
    'password|账户密码' => 'require',
    'repassword|确认密码'=>'require|confirm:password',
    'nickname|昵称' => 'require',
    'email|邮箱' => 'require|email',
    'code|重置密码' => 'require',
    'catename|栏目名称' => 'require|unique:cate',
    'sort|排序' => 'require',
     'id|ID' => 'require'
];
//    登陆验证场景
//    public function  sceneLogin()
//    {
//        return $this->only(['username','password']);
//    }
//验证场景
    protected	$scene = [
        //    登陆验证场景
        'sceneLogin' => ['username','password'],
        //    注册场景验证
        'sceneRegister' => ['username' => 'require|unique:admin','password','repassword','nickname','email'=>'require|unique:admin'],
//        重置密码验证场景
        'sceneReset' => ['code'],
//        栏目添加验证
        'sceneAdd' => ['catename','sort'],
//        排序验证场景
        'sceneSort' => ['sort','id'],
//        编辑验证场景
        'sceneEdit' => ['catename'],
        'sceneAdminEdit' => ['username' => 'require|unique:admin','nickname','email'=>'require|unique:admin']
    ];

//    注册场景验证
//    public  function sceneRegister()
//    {
//        return $this->only(['username','password','conpass','nickname','email']);
//    }
}
