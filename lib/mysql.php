<meta charset="utf8">
<?php

/*
*连接数据库
*@return resource连接成功 返回连接数据库的资源
*/

function mConn() {
	static $conn = null;
	if($conn === null) { //第一次调用
		$cfg = require(ROOT. '/lib/config.php');
		$conn =  mysqli_connect( $cfg['host'], $cfg['user'], $cfg['pwd'], $cfg['db']);
		mysqli_set_charset($conn, $cfg['charset']);
	}
	return $conn;
}

/*
*查询的函数
*@return mixed resourse/bool
*/
function mQuery($sql) {
	$rs = mysqli_query(mConn(), $sql);
	if($rs) {
		mLog($sql);
	} else {
		mLog($sql, "\n" .mysqli_error());
	}
	return $rs;
}

/**
*log 日志记录功能
*@param str $str 待记录的字符串
*
*/
function mLog($str) {
	$filename = ROOT. '/log/' . date('Ymd') . '.txt';
	$log = "-----------------------------------------------------\n" .date('Y/m/d H:i:s') . "\n" . $str ."\n". "-----------------------------------------------------\n\n";

	file_put_contents($filename, $log, FILE_APPEND); 
}



/*
*select 查询多行数据
*@param str $sql select 待查询的sql语句
*@return mixed   select查询成功返回二维数组 失败返回false
*/

function mGetAll($sql) {
	$rs = mQuery($sql);
	if(!$rs){
		return false;
	}

	$data = array();
	while($row = mysqli_fetch_assoc($rs)){
		$data[] =$row; 
	}
	return $data;
}

// $sql = "select * from cat";
// print_r(mGetAll($sql));

/*
*select 取出一行数据
*
*@param str $sql 待查询的sql语句
*@return arr/false 查询成功 返回一个一维数组
*/

function mGetRow($sql) {
	$rs = mQuery($sql);
	if(!$rs){
		return false;
	}

	return mysqli_fetch_assoc($rs);
}

// $sql  = "select * from cat where cat_id=1";
// print_r(mGetRow($sql));

/*
*select 查询返回一个结果
*
*@param str $sql 待查询的select语句
*@return mixed 成功 返回结果， 失败 返回false
*
*/

function mGetOne($sql) {
	$rs = mQuery($sql);
	if(!$rs) {
		return false;
	}

	return mysqli_fetch_row($rs)[0];
}

/*
*自动拼接insert和update sql语句， 并且调用mQuery()去执行sql
*
*@param str $table表名
*@param arr $data 接收到的数据, 一维数组
*@param str $act 动作 默认为'insert' 
*@return bool insert或者update成功或失败
*/

function mExec($table, $data, $act='insert', $where=0) {
	if($act == 'insert') {
		$sql = "insert into $table (";
		$sql .= implode(',', array_keys($data)) . ") values ('";
		$sql .= implode("','", array_values($data)) . "')";
		//echo $sql;
		return mQuery($sql);
	}else if ($act == 'update') {
		$sql = "update $table set ";
		foreach ($data as $key => $value) {
			$sql .= $key . "='" . $value . "', ";
		}
		$sql = rtrim($sql, ", ") . " where ".$where;
		return mQuery($sql);
	}
}

//$data = array('title'=>'今天的空气', 'content'=>'空气质量优', 'pubtime'=>12345678, 'author'=>'baibai');
//insert into art( title, content, publitme, author) values ('今天的空气', '空气质量优' ,12345678  ,'baibai');
//update art set title='今天的空气', content='空气质量优', pubtime='12345678', author='baibai' where ;
//echo mExec('art', $data);
// echo mExec('art', $data, $act='update', 'art_id=1');

/**
*
*取得上一步insert操作产生的主键id
*/
function getLastId() {
	return mysqli_insert_id(mConn());
}



?>