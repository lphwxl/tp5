<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Article as ArticleModel;
class Article extends Base
{
    //显示文章
    public function show() {
        $data  = ArticleModel::all();
        foreach ($data as $v){
            $v->edit = 'edit';
            $v->edit1 = 'id='.$v->id;
            $v->dele = 'dele';
            $v->dele1 = 'id='.$v->id;
        }
        $this->assign('data',$data);
        return $this->fetch();
    }
    //添加文章
    public function add(){
        $article = new ArticleModel;
        if(request()->isPost()){
            $res = $article->validate(true,[],true)->allowField(true)->save(input('post.'));
            $res?$this->success('添加成功 ',url('show')):$this->assign('msg',$article->getError());
        }
        $cate = model('Cate')->order('id asc')->select();
        $this->assign('data',array(
            'cates'=>$cate ));
        return $this->fetch();
    }
    //修改  : 完成图片的判断删除  以及 内容的显示 和新增内容
    public function edit($id=''){
        $data = ArticleModel::get($id);
        if(request()->isPost()){
            //内容新增   
            if($_FILES['pic']['error']===0){
                $path = str_pad($data->pic, strlen($data->pic)+1,'.',STR_PAD_LEFT);
                if(file_exists($path)){
                    //删除图片出现权限问题
                    @unlink(str_replace('\\', '/', $path));
                }    
            }
            $res = $data->validate(true,[],true)->allowField(true)->update(input('post.'));
            $res?$this->success('修改成功',url('show')):$this->assign('msg',$data->getError());
        }
        $cate = model('Cate')->order('id asc')->select();
        $this->assign('data',array(
            'cates'=>$cate,
            'article'=>$data
        ));
        return $this->fetch();
    }
    
    //删除文章时
    public function dele($id=''){
        $res = ArticleModel::destroy($id);
        $res? $this->success('删除成功',url('show')):$this->error('删除失败');
    }
}


