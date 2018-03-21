<?php



require('./lib/init.php');
$art_id = $_GET['art_id'];



if(!is_numeric($art_id)) {
	error('id is invalid');
}

$sql = "select * from art where art_id=$art_id";
if(!mGetRow($sql)){
	error('article does not exist');
}


$sql = "select * from cat";
$cats = mGetAll($sql);


if(empty($_POST) ) {

	$sql = "select cat_id, title, content from art where art_id=$art_id";
	$art = mGetRow($sql);

	include(ROOT. '/view/admin/artedit.html');

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

	$art['lastup'] = time();
	
	if( mExec('art', $art, 'update', "art_id=$art_id") ){
		succ('文章修改成功');
	}else {
		error('文章修改失败');
	}

}

?>











