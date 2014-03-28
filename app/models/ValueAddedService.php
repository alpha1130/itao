<?php
/**
 * ValueAddedService.php
 * 
 * $Id$
 */

class ValueAddedService extends Phalcon\Mvc\Model {
	
	public $vas_id;
	
	public $vas_type;
	
	public $vas_name;
	
	public $vas_price;
	
	public function initialize() {
		$this->hasOne('vas_type_id', 'ValueAddedType', 'vas_type_id');
	}
	
}

/* End of file ValueAddedService.php */