<?php
/**
 * ValueAddedType.php
 * 
 * $Id$
 */

class ValueAddedType extends Phalcon\Mvc\Model {
	
	public $vas_type_id;
	
	public $vas_type_name;
	
	public function initialize() {
		$this->belongsTo('vas_type_id', 'ValueAddedService', 'vas_type_id');
	}
	
}

/* End of file ValueAddedType.php */