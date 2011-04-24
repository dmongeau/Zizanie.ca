<?php


if($_POST && isset($_REQUEST['UPLOAD_IDENTIFIER']) && !empty($_REQUEST['UPLOAD_IDENTIFIER'])) {
	
	$this->setConfig('layout',dirname(__FILE__).'/response.layout.html');
	
	try {
		require PATH_APP.'/models/Page.php';
		$photo = Page::addPhoto($_FILES['photo'],$_REQUEST['UPLOAD_IDENTIFIER']);
		
		echo json_encode(array('success'=>true,'photo'=>$photo,'uploadKey'=>$_REQUEST['UPLOAD_IDENTIFIER']));
		
	} catch(Exception $e) {
		echo json_encode(array('success'=>false,'error'=>$e->getMessage(),'uploadKey'=>$_REQUEST['UPLOAD_IDENTIFIER']));
	}
	
} else {
	die('ERROR');
}