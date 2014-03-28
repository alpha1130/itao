<?php
/**
 * AuthMemberControllerBase.php
 * 
 * $Id$
 */

class AuthMemberControllerBase extends Phalcon\Mvc\Controller {
	
	/**
	 *
	 * @var Member
	 */
	public $member;
	
	public function beforeExecuteRoute($dispatcher) {
		$member = $this->session->get('member', '');
		$member = unserialize($member);
	
		if($member == false) {
			$this->response->setJsonContent(array(
				'status' => -1, 'message' => '未登录'))->send();
			exit;
		}
	
		$this->member = $member;
	}
	
}

/* End of file AuthMemberControllerBase.php */