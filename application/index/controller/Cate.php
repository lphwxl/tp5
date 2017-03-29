<?php 
    namespace app\index\controller;
    class Cate extends Base{
    public function index($cate_id=''){
        if(is_numeric($cate_id)){
            $cate = db('cate')->find($cate_id);
            $article = db('article')->where('cateid='.$cate_id)->paginate(4);
            $this->assign('cate',$cate);
            $this->assign('article',$article);
            return $this->fetch();
        }
    }
}


?>



