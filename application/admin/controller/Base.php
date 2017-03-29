<?php 
    namespace  app\admin\controller;
    use think\Controller;
    class Base extends Controller{
        public function __construct(){
            parent::__construct();
           /*  if(!session('?user')){
                $this->success('请先登录',url('index/index'));
            } */
        }
       
    }


?>