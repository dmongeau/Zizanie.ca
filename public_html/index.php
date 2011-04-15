<?php

define('PATH_ROOT',dirname(__FILE__));
define('PATH_PAGES',dirname(__FILE__).'/pages');
define('PATH_PLUGINS',dirname(__FILE__).'/../Gregory/plugins');


$config = array(

	'layout' => PATH_PAGES.'/_layout.html',
	
	'path' => array(
		'pages' => PATH_PAGES,
		'plugins' => PATH_PLUGINS
	),
	
	'error' => array(
		'404' => PATH_PAGES.'/404.html',
		'500' => PATH_PAGES.'/500.html'
	)
	
);


require PATH_ROOT.'/../Gregory/Gregory.php';

$app = new Gregory($config);


$app->addPlugin('db', array(
	'adapter' => 'pdo_mysql',
	'config' => array(
		'host' => 'localhost',
		'username' => 'zizanie',
		'password' => 'RvavWG8FNjPPdWnv',
		'dbname' => 'zizanie'
)));

$app->addRoute(array(
	'/' => 'home.php',
	'/creer/' => array(
		'page' => 'create/index.php'
	),
));


$app->addStylesheet('/statics/css/commons.css');
$app->addStylesheet('/statics/css/styles.css');
$app->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js');


$app->bootstrap();

ini_set('display_errors', 1);
error_reporting(E_ALL);

$app->run();

$app->render();


