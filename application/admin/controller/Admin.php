<?php 
    namespace app\admin\controller;
    use app\admin\model\Admin as AdminModel;
    use think\Loader;
    class Admin extends Base{

        //显示
        public function show(){
           
            $result = model('Admin')->paginate(5);
            $this->assign('list',$result);
            return $this->fetch();
        }
        
        
        //添加
        public function add(){
            //提交
            if(request()->isPost() && !empty($_POST)){
                //insert如果成功，返回影响的行数
                //验证
                $result = $this->validate(input('post.'), 'Admin.add',[],true);
                if($result === true){
                    //采用 AR 添加
                    $admin = model('Admin');
                    $admin->password = input('post.password');
                    $admin->username = input('post.username');
                    $res = $admin->allowField(true)->save();
                    $res? $this->success('添加管理员成功','admin/admin/show',[],3):$this->error('添加失败');
                }else{
                    $this->assign('msg',$result);
                }
            }
            //展示
            return $this->fetch();
        }
        //编辑
        public function edit($id=''){
            if(request()->isPost() && !empty($_POST)){
                //执行修改数据    update table set 
                $id =  input('post.id');
                $data = [
                    'username'=>input('post.username'),
                ];
                $admin =  model('Admin');
                $validate = Loader::validate('Admin');
                $res = $validate->batch()->scene('edit')->check(input('post.'));
                if($res){
                    if(!empty(input('post.password'))){
                        $data['password'] = md5(input('post.password'));
                    }
                    $res1 = $admin->where('id',$id)->update($data);
                    
                    $res1? $this->success('修改成功','/admin/admin/show'):$this->error('未做任何修改');
                }
            }
            isset($validate) && $this->assign('msg',$validate->getError());
            $result = AdminModel::get($id);
            $arr = $result->toArray();
            $this->assign('user',$arr);
            return $this->fetch();
        }
        
        //删除数据
        public  function dele($id='') {
            if(is_numeric($id)){
                if($id == 2){
                    $this->error('系统账户不允许删除');
                    return ;
                }
                $res = AdminModel::destroy($id);
                $res ? $this->success('删除成功','/admin/admin/show'):$this->error('操作失败');
            }
        }
        
        public function login(){
            if(request()->isPost()){
                if(captcha_check(input('post.code'))){
                    $rules = ['username'=>'require','password'=>'require'];
                    $msg = $this->validate(input('post.'), $rules,['username.require'=>'用户名不得为空','password.require'=>'密码不得为空'],true);
                   if($msg === true){
                       $admin  = new AdminModel();
                       $admin->password = input('post.password');
                       $res = $admin->where('username="'.input('post.username').'"')->find();
                       if($res['password'] === $admin->password){
                           session('uid',$res['id']);
                           session('user',$res['username']);
                           $this->success('登录成功',url('show'));
                           return ;
                       }else{
                           $this->assign('msg',array('password'=>'用户名或密码错误'));
                           return $this->fetch('index/login');
                       }
                   }
                   $this->assign('msg',$msg);
                }else{
                    $this->assign('msg',array('code'=>'验证码错误'));
                }
            }
            return $this->fetch('index/login');
        }
        
        
    }
    



?>