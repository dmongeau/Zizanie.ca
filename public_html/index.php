<?php

define('DOMAIN','zizanie.local');
define('PATH_ROOT',dirname(__FILE__));
define('PATH_PAGES',dirname(__FILE__).'/pages');
define('PATH_PLUGINS',dirname(__FILE__).'/../Gregory/plugins');

require PATH_ROOT.'/../Gregory/Gregory.php';
require PATH_ROOT.'/../Kate/Kate.php';

$config = include PATH_ROOT.'/config.php';

$app = new Gregory($config);
$app->addPlugin('db', $app->getConfig('db'));

$app->addRoute(array(
	'/' => 'home.php',
	'/creer/' => 'create/index.php',
	'/page/:permalink/' => 'page/index.php',
));

$app->setData('domain',DOMAIN);

$app->addStylesheet('/statics/css/commons.css');
$app->addStylesheet('/statics/css/styles.css');
$app->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js');

$app->bootstrap();

//ini_set('display_errors', 1);
//error_reporting(E_ALL);
$app->run(isset($_GET['url']) ? $_GET['url']:null);

$app->render();


