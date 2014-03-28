<?php
/**
 * MemberController.php
 * 
 * $Id$
 */

class MemberController extends AuthMemberControllerBase {
	
	public function profileAction() {
		var_dump($this->member);
	}
	
	public function setupAction() {
		
	}
	
}

/* End of file MemberController.php */