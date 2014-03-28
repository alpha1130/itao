<?php
/**
 * MemberExt.php
 * 
 * $Id$
 */

class MemberExt extends \Phalcon\Mvc\Model {
	
	public $user_id;
	
	public $realname;
	
	public $gender;
	
	public $mobile;
	
	public $birth_date;
	
	public $province;
	
	public $city;
	
	public $district;
	
	public $avatar;
	
	public $qq;
	
	public $create_at;
	
	public $active_at;
	
	public function beforeValidationOnCreate() {
		$this->realname = '';
		$this->gender = 0;
		$this->mobile = '';
		$this->birth_date = '0000-00-00';
		$this->avatar = 0;
		$this->qq = '';
		$this->create_at = $_SERVER['REQUEST_TIME'];
		$this->active_at = 0;
	}
	
}

/* End of file MemberExt.php */