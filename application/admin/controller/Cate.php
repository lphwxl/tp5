<?php

    namespace app\admin\controller;
    use think\Db;
    class Cate extends Base{
        //显示分类
        public function show(){
            $res = Db::name('cate')->order('id asc')->select();
            $this->assign('cate',$res);
            return $this->fetch();
        }
        
        //添加分类 
        public function add(){
            if(request()->isPost() && !empty(input('post.'))){
                $data = input('post.');
                $res = $this->validate($data, 'Link.cate');
                if(!is_string($res)){
                   $res =  Db::name('cate')->field('catename')->insert($data);
                   $res?$this->success('添加栏目成功','/admin/cate/show'):$this->error('添加栏目失败');               
                }
            }
            isset($res) && $this->assign('msg',$res);
            return $this->fetch();
        }
        //修改分类
        public function edit($id){
            if(request()->isPost() && !empty(input('post.'))){
               $data = input('post.');
               $res = $this->validate($data, 'Link.cate');
               if(!is_string($res)){
                   $res = Db::name('cate')->where('id',input('post.id'))->update($data);
                   $res?$this->success('修改成功','/admin/cate/show'):$this->error('修改失败');
               }
            }
            isset($res) && $this->assign('msg',$res);
            $res = Db::name('cate')->find($id);
            $this->assign('cate',$res);
            return $this->fetch();
        }
        
        //删除分类
        public function dele($id){
            $res = Db::name('cate')->delete($id);
            $res?$this->success('删除成功','admin/cate/show',2):$this->error('删除失败');
        }
    }


?>