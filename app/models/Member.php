<?php
/**
 * Member.php
 * 
 * $Id$
 */

class Member extends \Phalcon\Mvc\Model {
	
	const STATUS_UNAVALIABLE = 0;
	
	const STATUS_ACTIVE = 1;
	
	const STATUS_LOCK = 2;
	
	public $user_id;
	
	public $username;
	
	public $email;
	
	public $password;
	
	public $salt;
	
	public $status;
	
	public function initialize() {
		$this->hasOne('user_id', 'MemberCount', 'user_id');
		$this->hasOne('user_id', 'MemberExt', 'user_id');
		$this->hasOne('user_id', 'Balance', 'user_id');
		$this->hasMany('user_id', 'MemberOpenid', 'user_id');
	}
	
	public static function salt() {
		$salt = '';
		$loop = 8;
		$dict = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$max = strlen($dict) - 1;
		
		while($loop) {
			$char = $dict[rand(0, $max)];
			
			if($salt == '' || strpos($salt, $char) === FALSE) {
				$salt .= $char;
				--$loop;
			}
		}
		
		return $salt;
	}
	
	public static function password($password, $salt) {
		return hash('sha256', md5($password . $salt));
	}
	
	public function beforeValidation() {
		if($this->password) {
			$this->salt = self::salt();
			$this->password = self::password($this->password, $this->salt);
		}
	}
	
	public function beforeValidationOnCreate() {
		if(!$this->status) {
			$this->status = self::STATUS_UNAVALIABLE;
		}
	}
	
	public function validation() {
		$this->validate(new \Phalcon\Mvc\Model\Validator\Email(array(
			'field' => 'email',
			'message' => 'email invalid')));
		
		$this->validate(new \Phalcon\Mvc\Model\Validator\Regex(array(
			'field' => 'username',
			'pattern' => '/^[A-Za-z0-9_-]{5,30}$/',
			'message' => '用户名无效')));
		
		$this->validate(new \Phalcon\Mvc\Model\Validator\Regex(array(
			'field' => 'password',
			'pattern' => '/^[\w\W]{6,}$/i',
			'message' => '密码无效')));
		
		return $this->validationHasFailed() != true;
	}
	
}

/* End of file Member.php */