<?php
/**
 * config.php
 * 
 * $Id$
 */

return array(
	
	'loadDir' => array(
		'../app/controllers/api/',
		'../app/models/',
		'../app/plugins/',
		'../app/library/'
		),
	
	'logsDir' => '../app/logs/',
	
	'viewsDir' => '../app/views/api',
	
	'session' => array(
		'host' => '127.0.0.1',
		'port' => 11211,
		'lifetime' => 1800,
	),
	
	'database' => array(
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'itao',
		'options' => array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8')
	)
	
);

/* End of file config.php */