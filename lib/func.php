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


?>