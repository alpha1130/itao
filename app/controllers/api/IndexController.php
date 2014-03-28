<?php
/**
 * IndexController.php
 * 
 * $Id$
 */

class IndexController extends Phalcon\Mvc\Controller {
	
	public function indexAction() {
		
	}
	
	public function route404Action() {
		return $this->response->setJsonContent(array(
			'status' => -404, 'message' => 'route not found'));
	}
	
}

/* End of file IndexController.php */