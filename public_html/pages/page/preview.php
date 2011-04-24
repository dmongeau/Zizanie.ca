<?php



$route = $this->getRoute();

$this->setConfig('layout',dirname(__FILE__).'/layoutPreview.html');
$this->addStylesheet('/statics/css/page.css');
$this->addScript('/statics/js/page.js');

require_once PATH_APP.'/models/Page.php';

try {
	
	$Page = new Page();
	
	$Page->setData(array(
		'title' => NEC($_REQUEST,'title'),
		'type' => NEC($_REQUEST,'type'),
		'fontFamily' => NEC($_REQUEST,'fontFamily'),
		'titleSize' => NEC($_REQUEST,'titleSize'),
		'titleColor' => NEC($_REQUEST,'titleColor'),
		'titleAlign' => NEC($_REQUEST,'titleAlign'),
		'colorScheme' => NEC($_REQUEST,'colorScheme'),
		'backgroundColor' => NEC($_REQUEST,'backgroundColor'),
		'backgroundImage' => NEC($_REQUEST,'backgroundImage')
	));
	
	$page = $Page->getData();
	
	if($Page->isWebFont()) {
		$this->addStylesheet($Page->getWebFontUrl());
	}
	
	$this->setData('bodyclass',NE($page,'colorScheme','light').' '.$page['type']);
	$this->setData('url','http://'.DOMAIN.'/creer');
	$this->setData('title',$page['title']);
	
	if(!isset($_REQUEST['title']) || !isset($_REQUEST['type']) || empty($_REQUEST['title']) || empty($_REQUEST['type'])) {
		?>
        <div class="spacer"></div>
        <div class="spacer"></div>
        <div class="spacer"></div>
        <div class="spacer"></div>
        <p align="center">Vous devez entrer un titre et choisir un type de page pour voir l'aperçu.</p>
        <div class="spacer"></div>
        <div class="spacer"></div>
        <?php
	} else if($page['type'] == 'comments') {
		include dirname(__FILE__).'/types/comments.php';	
	} else if($page['type'] == 'battle') {
		include dirname(__FILE__).'/types/battle.php';	
	} else if($page['type'] == 'tweet') {
		include dirname(__FILE__).'/types/tweet.php';	
	}
	
} catch(Exception $e) {
	var_dump($e);	
}