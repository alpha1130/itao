<?php
/**
 * SignController.php
 *
 * $Id$
 */

class SignController extends Phalcon\Mvc\Controller {

	public function upAction() {
		$member = new Member();
		$member->memberCount = new MemberCount();
		$member->memberExt = new MemberExt();
		if($member->save($_GET, array('username', 'email', 'password')) == false) {
			$errorMessage = join("\n", $member->getMessages());

			return $this->response->setJsonContent(array(
				'status' => -1, 'message' => $errorMessage));
		}

		return $this->response->setJsonContent(array(
			'status' => 1, 'message' => '注册成功'));
	}

	public function inAction() {
		$email = $this->request->getQuery('email', 'email');
		$password = $this->request->getQuery('password', 'string');

		if($email == '') {
			return $this->response->setJsonContent(array(
				'status' => -1, 'message' => '请输入登录邮箱地址'));
		}

		if($password == '') {
			return $this->response->setJsonContent(array(
				'status' => -1, 'message' => '请输入登录密码'));
		}

		$member = Member::findFirstByEmail($email);
		if($member == false ||
			Member::password($password, $member->salt) != $member->password) {
			return $this->response->setJsonContent(array(
				'status' => -1, 'message' => '登录邮箱与密码不匹配'));
		}

		$this->session->set('member', serialize($member));

		return $this->response->setJsonContent(array(
			'status' => 1,
			'message' => '登录成功',
			'user_id' => $member->user_id));
	}

	public function outAction() {
		if($this->session->has('member')) {
			$this->session->remove('member');
			$this->session->destroy();
		}
		
		return $this->response->setJsonContent(array(
			'status' => 1, 'message' => '注销成功'));
	}

}

/* End of file SignController.php */