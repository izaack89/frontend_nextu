<?php

session_destroy();
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
$actual_link= str_replace("server/logout.php", "client/index.html", $actual_link);
header("Location: $actual_link");
 ?>
