<?php

define('DOMAIN','zizanie.local');
define('PATH_APP',dirname(__FILE__).'/../app');
define('PATH_ROOT',dirname(__FILE__));
define('PATH_PAGES',PATH_ROOT.'/pages');
define('PATH_PLUGINS',PATH_APP.'/Gregory/plugins');
ini_set('display_errors', 1);
error_reporting(E_ALL);


require PATH_APP.'/Gregory/Gregory.php';
require PATH_APP.'/Kate/Kate.php';
require PATH_APP.'/lib/functions.php';


$config = include PATH_APP.'/config.php';
$app = new Gregory($config);


$app->addPlugin('db', $app->getConfig('db'));


$app->addRoute(array(
	'/' => 'home.php',
	'/creer/' => 'create/index.php',
	'/apercu/' => 'page/preview.php',
	'/page/:permalink/' => 'page/index.php',
	
	'/upload/' => 'upload/upload.php',
	'/upload/progress/' => 'upload/progress.php',
));


$app->setData('domain',DOMAIN);

$app->addStylesheet('/statics/css/commons.css');
$app->addStylesheet('/statics/css/styles.css');
$app->addScript('/statics/js/jquery.js');


$app->bootstrap();

$app->run(isset($_GET['url']) ? $_GET['url']:null);

$app->render();


