<?php
/**
 * MemberActive.php
 * 
 * $Id$
 */

class MemberActive extends \Phalcon\Mvc\Model {
	
	const TYPE_SIGN_UP = 10;
	
	const TYPE_SIGN_IN = 11;
	
	const TYPE_SIGN_OUT = 12;
	
	public $active_id;
	
	public $user_id;
	
	public $active_type;
	
	public $active_ip;
	
	public $active_time;
	
	public $active_memo;
	
	public $active_extra;
	
	public function initialize() {
		$this->belongsTo('user_id', 'Member', 'user_id');
	}
	
	public function beforeSave() {
		$this->active_extra = serialize($this->active_extra);
	}
	
	public function beforeFetch() {
		$this->active_extra = unserialize($this->active_extra);
	}
	
	public function beforeValidationOnCreate() {
		$this->active_time = $_SERVER['REQUEST_TIME'];
	}
	
}

/* End of file MemberActive.php */