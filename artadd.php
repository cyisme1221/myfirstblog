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
	//收集tag
	$art['arttag'] =trim($_POST['tag']); 

	//插入内容到art表
	if(!mExec('art', $art)){
		error('article publish fail！');
	}else{
		//判断是否有tag
		$art['tag'] = trim($_POST['tag']);
		if($art['tag'] ==''){

			//将cat的num字段 +1；
			$sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
			mQuery($sql);

			succ('article successfully published');
		}else {
			//获取上次insert操作产生的主键id
			$art_id=getLastId();
			//插入tag到tag表
			//linux, mysql, php
			//insert into tag(art_id, tag) values (5, 'linux'), (5, 'mysql'), (5, 'php');
			
			$tag = explode(',', $art['tag']); //索引数组
			//print_r($tag);  
			$sql = "insert into tag (art_id, tag) values ";
			foreach ($tag as $v) {
				$sql .= "(". $art_id. ", '" . $v . "') ,";
			}
			$sql = rtrim($sql, "," );
			echo $sql;

			if(mQuery($sql)){
			//将cat的num字段 +1；
			$sql = "update cat set num=num+1 where cat_id=$art[cat_id]";
			mQuery($sql);
				succ('文章添加成功');
			}else {
				//tag添加失败 并删除原文章
				$sql = "delete from art where art_id=$art_id";

				if(mQuery($sql)){
					error('文章添加失败');
									}
			}
		}

		
	}


}


?>