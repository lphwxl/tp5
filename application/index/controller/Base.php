<?php 
    namespace app\index\controller;
    use think\Controller;
    class Base extends Controller{
        public function _initialize(){
            $cate = db('cate')->order('id  asc')->select();
            //热门点击
            $arrclick = db('article')->field('id,title')->order('click desc')->limit(0,4)->select();
            //推荐阅读
            $tui = db('article')->field('id,title')->where('state=1')->order('click desc')->limit(0,4)->select();
            $this->assign('tuijian',$tui);
            $this->assign('cates',$cate);
            $this->assign('arrclick',$arrclick);
        }
    }


?>



