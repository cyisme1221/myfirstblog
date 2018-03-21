<?php

$cat_id= $_GET['cat_id'];
// echo $cat_id;



$con = mysqli_connect('localhost', 'root', 'root', '1224blog');
$con->set_charset('utf8');

//检测栏目id是否为数字
// var_dump($cat_id);

if( !is_numeric($cat_id) ){
	echo "invalid, id needs to be a number";
	exit();
}

//检测id是否存在
$sql = "select count(*) from cat where cat_id= $cat_id";

$rs = mysqli_query($con, $sql);
$row = mysqli_fetch_row($rs);
if($row[0]==0 ){
	echo '栏目不存在';
	exit();
}

//检测栏目下是否有文章
$sql = "select count(*) from art where cat_id= $cat_id";

$rs = mysqli_query($con, $sql);
$row = mysqli_fetch_row($rs);
if($row[0]!=0){
	echo '有文章, 不能删除';
	exit();
}

//检测完毕 删除项目
$sql= "delete from cat where cat_id=$cat_id";
if(mysqli_query($con, $sql)){
	echo '删除成功';
}else {
	echo '删除失败';
}
?>