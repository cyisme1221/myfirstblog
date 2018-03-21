<?php


require('./lib/init.php');
$art_id = $_GET['art_id'];

$sql="delete from art where art_id=$art_id";
if ( !mQuery($sql) ){
	error('Fail to delete');

} else {
	header('Location: artlist.php');
}

?>