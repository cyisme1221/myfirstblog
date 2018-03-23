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


//分页代码
$sql = "select count(*) from art where 1". $where; //获取总的文章数
$num_of_articles = mGetOne($sql);

$current_page_number = isset($_GET['page']) ? $_GET['page'] : 1; //当前页码数
$each_page_number = 2;

$page = getPage($num_of_articles, $current_page_number, $each_page_number);

// print_r($page);
// exit();

//查询所有文章
$sql = "select art_id, title, content, pubtime, comm, catname from art inner join cat on art.cat_id=cat.cat_id where 1 " . $where . ' order by art_id desc limit ' . ($current_page_number - 1) * $each_page_number . ',' . $each_page_number;
$arts = mGetAll($sql);

//如果当前栏目下没有文章 跳转到首页去
if(empty($arts)){
	header('Location:index.php');
	exit();
}

include(ROOT .'/view/front/index.html');
?>
