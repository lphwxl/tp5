<?php
namespace app\admin\controller;
use think\Request;
class Index extends Base
{
    //用户登录界面
    public function index(Request $request)
    {
        return $this->fetch('index/login');
    }
}
