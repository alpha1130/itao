<?php
/**
 * TradeController.php
 * 
 * $Id$
 */

class TradeController extends AuthMemberControllerBase {
	
	public function indexAction() {
		
	}
	
	public function viewAction() {
		
	}
	
	public function showAction() {
		
	}
	
	public function hideAction() {
		
	}
	
	public function createAction() {
		$trade = new Trade();
		$tradeDetail = new TradeDetail();
		$tradeDetail->content = $this->request->getQuery('content', 'string');
		$trade->tradeDetail = $tradeDetail;
		$trade->user_id = $this->member->user_id;
		$trade->username = $this->member->username;
		$trade->flag = Trade::FLAG_DRAFT;
		
		$is_succ = $trade->save($_GET, array('title', 'mode', 'category', 'price'));
		if($is_succ == false) {
			$errorMessage = join(',', $trade->getMessages());
			
			return $this->response->setJsonContent(array(
				'status' => -1, 'message' => $errorMessage));
		}
		
		return $this->response->setJsonContent(array(
			'status' => 1, 'message' => '交易建立成功', 
			'trade_id' => $trade->trade_id));
	}
	
	public function editAction() {
		
	}
	
}

/* End of file TradeController.php */