<?php
require ('./lib/init.php');

//require('./view/admin/catlist.html');  先引入的话 $cat在catlist.html中不生效，  艹 

$con = mysqli_connect('localhost', 'root', 'root', '1224blog');
$con->set_charset('utf8');

$sql = "select * from cat";
$rs = mysqli_query($con, $sql);

/*
$catlist_arr = mysqli_fetch_all($rs);
print_r($catlist_arr);
*/

$cat = array();
while ($row = mysqli_fetch_assoc($rs)) {
	$cat[] = $row;
}
 // print_r('<pre>');
 // print_r($cat);

 require(ROOT.'/view/admin/catlist.html');  
