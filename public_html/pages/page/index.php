<?php



$route = $this->getRoute();

$this->setConfig('layout',dirname(__FILE__).'/layout.html');
$this->addStylesheet('/statics/css/page.css');
$this->addScript('/statics/js/page.js');

require_once PATH_APP.'/models/Page.php';

try {
	
	$Page = new Page($route['params']['permalink']);
	$page = $Page->fetch();
	
	if($Page->isWebFont()) {
		$this->addStylesheet($Page->getWebFontUrl());
	}
	
	$this->setData('bodyclass',NE($page,'colorScheme','light').' '.$page['type']);
	$this->setData('url','http://'.$_SERVER['HTTP_HOST']);
	$this->setData('title',$page['title']);
	
	if($page['type'] == 'comments') {
		include dirname(__FILE__).'/types/comments.php';	
	} else if($page['type'] == 'battle') {
		include dirname(__FILE__).'/types/battle.php';	
	} else if($page['type'] == 'tweet') {
		include dirname(__FILE__).'/types/tweet.php';	
	}
	
} catch(Exception $e) {
	var_dump($e);	
}