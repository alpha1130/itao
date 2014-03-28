<?php
/**
 * Balance.php
 * 
 * $Id$
 */

class Balance extends Phalcon\Mvc\Model {
	
	public $user_id;
	
	public $balance;
	
	public function beforeValidationOnCreate() {
		if($this->balance == NULL) {
			$this->balance = 0;
		}
	}
	
}

/* End of file Balance.php */