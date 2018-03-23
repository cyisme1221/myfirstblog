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
?>