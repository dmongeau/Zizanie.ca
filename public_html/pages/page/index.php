<?php



$route = $this->getRoute();

$this->setConfig('layout',dirname(__FILE__).'/_layout.html');
$this->addStylesheet('/statics/css/page.css');

require_once PATH_APP.'/models/Page.php';

try {
	$Page = new Page($route['params']['permalink']);
	$page = $Page->fetch();
	
	if($page['type'] == 'comments') {
		include dirname(__FILE__).'/comments.php';	
	}
} catch(Exception $e) {
	var_dump($e);	
}