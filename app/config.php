<?php

return array(

	'layout' => PATH_PAGES.'/_layout.html',
	
	'path' => array(
		'pages' => PATH_PAGES,
		'plugins' => PATH_PLUGINS
	),
	
	'error' => array(
		'404' => PATH_PAGES.'/404.html',
		'500' => PATH_PAGES.'/500.html'
	),
	
	'recaptcha' => array(
		'public' => '6Lcmj8MSAAAAALpckh90DYDz-38rWR4huC7USTeo',
		'private' => '6Lcmj8MSAAAAAO944Ctnwpg-8-H3WJlVZm1i3EZ-'
	),
	
	'db' => array(
		'adapter' => 'pdo_mysql',
		'config' => array(
			'host' => 'localhost',
			'username' => 'zizanie',
			'password' => 'RvavWG8FNjPPdWnv',
			'dbname' => 'zizanie'
		)
	)
	
);