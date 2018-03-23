<?php


require('./lib/init.php');	

$sql = "select cat_id, catname from cat";
$cats = mGetAll($sql);

//判断地址栏是否有cat_id;
if(isset($_GET['cat_id'])) {
	$where = " and art.cat_id=" .$_GET[cat_id];
}else {
	$where='';
}


$sql = "select art_id, title, content, pubtime, comm, catname from art inner join cat on art.cat_id=cat.cat_id where 1 " . $where ;
$arts = mGetAll($sql);

//如果当前栏目下没有文章 跳转到首页去
if(empty($arts)){
	header('Location:index.php');
	exit();
}

include(ROOT .'/view/front/index.html');
?>
