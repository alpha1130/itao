<?php
/**
 * MemberCount.php
 * 
 * $Id$
 */

class MemberCount extends \Phalcon\Mvc\Model {
	
	public $uid;
	
	public $gold;
	
	public $health;
	
	public $credit;
	
	public function beforeValidationOnCreate() {
		$this->gold = 0;
		$this->health = 0;
		$this->credit = 0;
	}
	
}

/* End of file MemberCount.php */