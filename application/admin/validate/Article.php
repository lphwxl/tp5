<?php 
    namespace app\admin\validate;
    use think\Validate;
    
    class Article extends Validate
    {
        protected $rule = [
            ['title','require','标题不得为空'],
            ['cateid','require|notIn:0','分类不得为空|必须选择一个分类']
        ];
        
        
    }
?>