
<?php

$cat_id = $_GET['cat_id'];

$con = mysqli_connect('localhost', 'root', 'root', '1224blog');
mysqli_set_charset($con, 'utf8');
	
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


if( empty($_POST) ) {

	$sql = "select catname from cat where cat_id = $cat_id";
	$rs = mysqli_query($con, $sql);
	$cat = mysqli_fetch_assoc($rs);
	// print_r($cat);
	require('./view/admin/catedit.html');
} else {

	$sql = "update cat set catname='$_POST[catname]' where cat_id=$cat_id";
	if(!mysqli_query($con, $sql)){
		echo 'update fail';
	}else{
		echo 'update success';
	}

}




?>