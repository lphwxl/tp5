<?php 
    namespace app\index\controller;
    use think\Db;
    class Article extends Base{
        public function detail($id=''){
            if(is_numeric($id)){
                dump(basename(__FILE__));die;
                db('article')->where('id='.$id)->setInc('click');
                $res = db('article')->alias('a')
                ->field('c.catename,a.cateid,a.desc,a.title,a.keywords,a.content,a.author,a.time,a.click')->where('a.id='.$id)
                ->join('tp_cate c','c.id=a.cateid','left')
                ->find();
                $resall = db('article')->field('id,title,pic')->where('cateid='.$res['cateid'])
                        ->where('id','<>',$id)->where('state=1')
                        ->order('click desc')->limit(6)->select();
                $this->assign('resall',$resall);
                $this->assign('detail',$res);
                return $this->fetch(); 
            }
        }
        
        public function search(){
            $key = input('post.q');
            if(!empty($key)){
                require_once EXTEND_PATH.'sphinx'.DS.'sphinxapi.php';
                $sph = new \SphinxClient();
                //dump($sph);die;
                $sph->SetServer('localhost',9312);
                $sph->SetMatchMode(SPH_MATCH_ALL);
                $res = $sph->Query($key,'*');
                if(!empty($res['matches'])){
                    $ids = implode(',', array_keys($res['matches']));
                    $res = Db::name('article')->field('id,title,pic,desc,time')->select($ids);
                    $conf = array(
                        'before_match'=>'<span style="color:red;">',
                        'after_match'=>'</span>'
                    );
                    $title = array();
                    foreach ($res as $v){
                        $title[] = $v['title'];
                    }
                    $title = $sph->BuildExcerpts($title, 'main', $key,$conf);
                    foreach ($res as $k=>$v){
                        $res[$k]['title'] = $title[$k];
                        $res[$k]['pic'] = str_replace('\\', '/', $res[$k]['pic']);
                    }
                    $this->assign('article',$res);
               }
          }
          return $this->fetch();
        }
    }
?>



