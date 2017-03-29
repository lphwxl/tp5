<?php 

    namespace app\admin\controller;
    use think\Controller;
    class Tags extends Controller{
        //展示标签
        public function showlist(){
            
            return $this->fetch();
        }
        //添加标签
        public function add(){
            
            
            return $this->fetch();
        }
        
        
        //修改标签
        public function edit(){
            
            
            return $this->fetch();
        }
        //删除标签
        public function dele(){
            
            
            $this->fetch();
        }
    }


    
    
    
    
?>