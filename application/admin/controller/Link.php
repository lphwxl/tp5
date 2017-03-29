<?php 
    namespace app\admin\controller;
    use think\Db;
    use think\Loader;
    class Link extends Base{
           
        //显示
        public function show(){
            $list = Db::name('links')->paginate(6);
            $mark = !empty($list->toArray()['data']);
            $this->assign('mark',$mark);
            $this->assign('list',$list);
            return $this->fetch();
        }
        //添加链接
        public function add(){
            if(request()->isPost() && !empty(input('post.'))){
                $validate = Loader::validate('link');
                $res = $validate->batch()->scene('add')->check(input('post.'));
                if($res){
                    $res = Db::name('links')->field('title,url,desc')->insert(input('post.'));
                    $res?$this->success('添加成功','/admin/link/show',2):$this->error('添加失败');
                }
            }
            isset($res) && $this->assign('msg',$validate->getError());
            return $this->fetch();
        }
        
        //编辑信息
        public function edit($id){
            if(request()->isPost()){
                $id = input('post.id');
                $res = $this->validate(input('post.'),'link.edit',[],true);
                if(!is_array($res)){
                    input('post.url','','addslashes');
                    $data = [
                        'title'=>input('post.title'),
                        'url'=>input('post.url'),
                        'desc'=>input('post.desc')
                    ];
                    $res = db('links')->where('id',$id)->update($data);
                    $res?$this->success('修改成功','/admin/link/show'):$this->error('修改失败','/admin/link/show');
                }
            }
            isset($res) && $this->assign('msg',$res);
            $resone = db('links')->find($id);
            $this->assign('result',$resone);
            return $this->fetch();
        }
        //删除
        public function dele($id){
            $res = db('links')->delete($id);
            $res?$this->success('删除成功','/admin/link/show'):$this->error('删除失败');
        }
        
        
        
    }



?>