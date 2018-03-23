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

	$sql = "select * from art where art_id=$art_id";
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
		//删除tag表中原有tag 再insert插入新的tag
		$sql="delete from tag where art_id=$art_id";
		mQuery($sql);

		//添加新tag
		$sql="insert into tag (art_id, tag) values ";
		foreach ($tag as $v) {
			$sql .= "(".$art_id . ", '" .$v . "'),";
		}
		$sql=trim($sql, ',');
		if(mQuery($sql)){
			succ('article updated');
		}
	}else {
		error('文章修改失败');
	}

}

?>











