<?php
    namespace app\admin\validate;
    use think\Validate;
    class Link extends Validate{
        protected $rule=[
            'title'=>'require|unique:links,title',
            'url'=>'require|url',
            'desc'=>'requireWith:desc|min:20',
            'catename'=>'require|unique:cate,catename|min:2'
        ];
        
        
        protected  $message = [
            'title.require'=>'标题不能为空',
            'url.url'=>'url地址不正确',
            'desc'=>'最小长度为20位',
            'catename.require'=>'栏目不能为空',
            'catename.unique'=>'栏目名称必须唯一'
        ];
        protected $scene = [
            'add'=>['title','url','desc'],
            'edit'=>['url','title'],
            'cate'=>['catename']
            
        ];
    }
    


?>