<?php
    namespace app\admin\model;
    use think\Model;
    class Admin extends Model{
        
        //修改器
        protected function setPasswordAttr($pwd){
            return md5($pwd);
        }
    }


?>