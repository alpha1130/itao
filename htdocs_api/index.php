<?php
/**
 * index.php
 * 
 * $Id$
 */

use \Phalcon\Logger;

try {
	
	$config = include __DIR__ . '/../app/config/config.php';
	
	$loader = new \Phalcon\Loader();
	$loader
		->registerDirs($config['loadDir'])
		->register();
	
	$di = new \Phalcon\DI\FactoryDefault();
	$di->set('db', function() use ($config){
		$evt = new \Phalcon\Events\Manager();
		$logger = new \Phalcon\Logger\Adapter\File($config['logsDir'] . 'db.debug.log');
		
		$evt->attach('db', function($event, $connection) use ($logger) {
			if($event->getType() == 'beforeQuery') {
				$logger->log($connection->getSQLStatement(), Logger::INFO);
			}
		});
		
		$connection = new \Phalcon\Db\Adapter\Pdo\Mysql($config['database']);
		$connection->setEventsManager($evt);
		
		return $connection;
	});
	$di->set('view', function() use ($config) {
		$view = new \Phalcon\Mvc\View();
		$view->setViewsDir($config['viewsDir']);
		
		return $view;
	});
	$di->setShared('session', function() use ($config){
		ini_set('session.name', 'sid');
		$session = new Phalcon\Session\Adapter\Memcache($config['session']);
		$session->start();
		
		return $session;
	});
	$di->set('modelsMetadata', function(){
		$metaData = new \Phalcon\Mvc\Model\MetaData\Apc(array(
			'lifetime' => 3600,
			'prefix' => 'my-prefix'));
		
		return $metaData;
	});
	
	$app = new \Phalcon\Mvc\Application($di);
	$app->handle()->send();
	
} catch(Phalcon\Mvc\Dispatcher\Exception $e) {
	
	$app->handle('/index/route404')->send();
	
} catch(Exception $e) {
	echo $e->getMessage();
	
}

/* End of file index.php */