<?php
	//Memcache 的使用
	$memcache =  new Memcache();
	$memcache->connect('localost',11233);
	$mark = $memcache->add('name','zhansan',true,0);
	if($mark){
		$res = $memcache->get('name');
		var_dump($res);
	}

//memcache 的使用    增删改查
$memche = new memcache();
$memcache->connect('localhost',11233);
$memcache->add('sex','男',true,0);
$res2 = $memcache->get('sex');
var_dump($res2);

?>
