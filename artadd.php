<?php 

require('./lib/init.php');

$sql = "select * from cat";
$cats = mGetAll($sql);


if(empty($_POST)){
	include(ROOT. '/view/admin/artadd.html');
} else {
	// check if title is empty
	$art['title'] = trim($_POST['title']);

	if($art['title'] == ''){
		error('title can not be empty!');
	}

	// check if title is valid
	$art['cat_id'] = $_POST['cat_id'];
	if(is_numeric($cat_id)) {
		error ('title is invalid');
	}

	//check if content valid
	$art['content'] = trim($_POST['content']) ;
	if($art['content'] == '') {
		error('content can not be empty');
	}

	$art['pubtime'] = time();
	//插入内容到art表
	if(!mExec('art', $art)){
		error('article publish fail！');
	}else{
		succ('article successfully published');
	}


}


?>