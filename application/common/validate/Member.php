<?php


namespace app\common\validate;


use think\Validate;

class Member extends Validate
{
    //通用验证
    protected $rule = [
        'username|用户名' => 'require|unique:member',
        'password|密码' => 'require',
        'nickname|昵称' => 'require',
        'email|邮箱' => 'require|unique:member|email'
    ];

    //场景验证
    protected $scene = [
        'sceneAdd' => ['username','password','nickname','email'],
        'sceneEdit' => ['username','nickname','email']
    ];

}