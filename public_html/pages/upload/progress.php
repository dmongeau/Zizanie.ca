<?php

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 
if (@$_GET['uploadKey']) {
	echo json_encode(uploadprogress_get_info($_GET['uploadKey']));
	exit();
} else {
	exit();	
}