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


$sql="delete from art where art_id=$art_id";
if ( !mQuery($sql) ){
	error('Fail to delete');

} else {
	header('Location: artlist.php');
}

?>