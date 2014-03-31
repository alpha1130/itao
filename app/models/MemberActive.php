<?php
/**
 * MemberActive.php
 * 
 * $Id$
 */

class MemberActive extends \Phalcon\Mvc\Model {
	
	public $active_id;
	
	public $user_id;
	
	public $username;
	
	public $active_type;
	
	public $active_time;
	
	public $active_memo;
	
	public function initialize() {
		$this->belongsTo('user_id', 'Member', 'user_id');
	}
	
}

/* End of file MemberActive.php */