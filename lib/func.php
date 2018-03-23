<?php  

function succ($res){
	$result = 'succ';
	require(ROOT.'/view/admin/info.html');
	exit();
}

function error($res){
	$result = 'fail';
	require(ROOT.'/view/admin/info.html');
	exit();
}


//获取来访者的ip
function getRealIp(){
	static $realip = null;
	if($realip !==null){
		return $realip;
	}

	if(getenv('REMOTE_ADDR')) {
		$realip = getenv('REMOTE_ADDR');
	} else if (getenv('HTTP_CLIENT_IP')) {
		$realip = getenv('HTTP_CLIENT_IP');
	} else if (getenv('HTTP_X_FORWARD_FOR')){
		$realip = getenv('HTTP_X_FORWARD_FOR');
	}
}


/*
*生成分页码
*每次生成5页
*@param int $num_of_articles 文章总数
*@param int $current_page_number  当前显示的页码数  $current_page_number -2, 
*@param int $each_page_number
*
*/
function getPage($num_of_articles, $current_page_number, $each_page_number) {
	//最大的页码数 
	$max = ceil($num_of_articles / $each_page_number) ;

	//最左侧页码
	$left = max(1, $current_page_number - 2);

	//最右侧页码
	$right = min ($left+4, $max);

	$left = max(1, $right-4);

	$page = array();
	for ($i=$left; $i <=$right ; $i++) { 
		$_GET['page']=$i;
		$page[$i] = http_build_query($_GET);
	}
	return $page;
}

// print_r (getPage(100, 5, 10));

?>