<?php 

// echo __DIR__ , '<br>'; 
// echo __FILE__, '<br>';
// echo __LINE__, '<br>';
// echo dirname(__DIR__) , '<br>'; 


header('Content-type:text/html;charset=utf8');
define('ROOT', dirname(__DIR__));
require(ROOT.'/lib/mysql.php');
require(ROOT.'/lib/func.php');

?>