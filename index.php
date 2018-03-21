<?php


require('./lib/init.php');	

$sql = "select catname from cat";
$cats = mGetAll($sql);


$sql = "select title, content, pubtime, comm, catname from art inner join cat on art.cat_id=cat.cat_id";
$arts = mGetAll($sql);


require(ROOT .'/view/front/index.html');
