<?php 
    namespace app\index\controller;
    class Index extends Base{
    public function index(){
        $article = db('article')->order('id asc')->where('is_del','=','0')->paginate(4);
        $this->assign('article',$article);
        return $this->fetch();
    }
}


?>



