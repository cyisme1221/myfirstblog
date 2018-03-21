<?php

require('./lib/init.php');

if(empty($_POST)) {

	include(ROOT.'/view/admin/catadd.html');
} else {
	//print_r($_POST);

	//链接数据库
	// $mysqli = mysqli_connect('localhost', 'root', 'root', '1224blog');
	// mysqli_set_charset($mysqli, 'utf8');
	//检测是否链接成功
	/*
	if( !$mysqli ){
		die('连接失败' . mysqli_connect_error());
	}else {
		echo '连接成功';
	}
	*/

	//检测栏目是否为空
	$cat['catname'] = trim($_POST['catname']);
	if( empty($cat['catname']) ) {
		error('栏目不能为空');
		exit;
	}

	//检测栏目名是否已存在
	$sql = "select count(*) from cat where catname='$cat[catname]'";
	$rs = mQuery($sql);
	
	if(mysqli_fetch_row($rs)[0] != 0){
		error(' 栏目已经存在');
		exit();
	}
	

	//将栏目写入栏目表
	// $sql = " insert into cat (catname) values ('$cat[catname]')";
	if( !mExec('cat', $cat)) {
		error('栏目插入失败');
		//echo mysqli_error();
	}else {
		succ('栏目插入成功啦啊啊');
	}
	
	

	

}


?>