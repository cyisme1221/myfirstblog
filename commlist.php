<?php

require('./lib/init.php');
$sql = "select * from comment";

//获取所有的comms到数组
$comms = mGetAll($sql);

require(ROOT. '/view/admin/commlist.html');
?>
