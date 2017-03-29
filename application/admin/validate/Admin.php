<?php
    namespace app\admin\validate;
    
    use think\Validate;
    class Admin extends Validate{
        //验证规则
        protected $rule = [
            ['username','require|length:5,16|unique:Admin,username','用户名不能为空|长度必须在5-16位之间|用户名必须唯一'],
            ['password','require|length:6,20|alphaNum','密码不能为空|长度必须在6-20位之间|只能是数字或者字母']
        ];
        
        //验场景
       protected $scene = [
           'add'=>['username','password'],
           'edit'=>['username','password'=>'requireWith:password|length:6,20'],
       ];
       protected $message = [];
    }



?>