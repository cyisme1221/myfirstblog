<?php

require ('./lib/init.php');

$art_id = $_GET['art_id'];

//判断地址栏传来的art_id是否合法
if(!is_numeric($art_id)) {
	header('Location: index.php');
}

//如果没有这篇文章
$sql = "select * from art where art_id = $art_id";
if( !mGetRow($sql)) {
	header('Location: index.php');
}

//查询文章
$sql ="select * from art inner join cat on art.cat_id=cat.cat_id where art_id=$art_id";
$art = mGetRow($sql);

//查询所有留言
$sql= "select * from comment where art_id=$art_id";
$comms = mGetAll($sql);


//post非空代表有留言 
if(!empty($_POST)){
	$comm['nick'] =trim($_POST['nick']) ;
	$comm['email'] =trim($_POST['email']) ;
	$comm['content'] =trim($_POST['content']) ;
	$comm['pubtime'] = time() ;
	$comm['art_id'] = $art_id;
	//$rs = mExec('comment', $comm);

	//获取用户的ip
	$comm['ip'] = $sprintf('%u', ip2long(getRealip()));

	if($rs) {
		//评论发布成功，将art表的comm +1
		$sql = "update art set comm=comm+1 where art_id=$art_id";
		mQuery($sql);	

		//跳转到上个页面
		$ref = $_SERVER['HTTP_REFERER'];
		header("Location: $ref");
	}
}

include(ROOT .'/view/front/art.html');

?>