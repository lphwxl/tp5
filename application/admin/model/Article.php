<?php 

    namespace app\admin\model;
    use think\Model;
    use think\Image;
    class Article extends Model{
        protected $autoWriteTimeStamp = true;
        //静态
        protected static function init(){
            Article::event('before_insert',function($data){
               $data->time = time();
               self::filedel($data);
            });
            Article::event('before_update', function($data){
               self::filedel($data);
            });
        }
        
        //公共代码块 
        protected static function filedel(&$data){
            $data->state = isset($data->state)?1:0;
            if($_FILES['pic']['error'] === 0){
                $fileObj = request()->file('pic');
                $z = $fileObj->move('.'.DS.'upload'.DS.'bigsmall');
                if($z){
                    $path = $z->getPathName();
                    //缩略图制作                                   
                    $img =Image::open($path);
                    $path2 = $path2 = $z->getPath().DS.'thumb_'.$z->getFileName();
                    $img->thumb(250, 250,1)->save($path2);
                    $data->pic = ltrim($path2,'.');
                }
            }
            $data->content =  phpfilter($_POST['content']);
        }
    }
?>