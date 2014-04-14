<?php
/**
 * TradeController.php
 * 
 * $Id$
 */

class TradeController extends AuthMemberControllerBase {
	
	const ORDER_BY_PUB_TIME_DESC = 1;
	
	const ORDER_BY_PUB_TIME_ASC = 2;
	
	const ORDER_BY_PRICE_DESC = 3;
	
	const ORDER_BY_PRICE_ASC = 4;
	
	public function indexAction() {
		$id = $this->request->getQuery('id', 'int');
		$category = $this->request->getQuery('category', 'int');
		$startPrice = $this->request->getQuery('startPrice', 'int');
		$endPrice = $this->request->getQuery('endPrice', 'int');
		$query = $this->request->getQuery('query', 'string');
		$order = $this->request->getQuery('order', 'int');
		
		$filter = array();
		$filter['conditions'] = 'flag = :flag:';
		$filter['bind']['flag'] = Trade::FLAG_PUB;
		$filter['limit'] = 5;
		
		if($category) {
			$filter['conditions'] .= ' AND category = :category:';
			$filter['bind']['category'] = $category;
		}
		
		if($startPrice > 0) {
			$filter['conditions'] .= ' AND price >= :start:';
			$filter['bind']['start'] = $startPrice;
		}
		
		if($endPrice > 0) {
			$filter['conditions'] .= ' AND price <= :end:';
			$filter['bind']['end'] = $endPrice;
		}
		
		if($query) {
			$filter['conditions'] .= ' AND title LIKE :query:';
			$filter['bind']['query'] = $query . '%';
		}
		
		if($id) {
			$filter['conditions'] .= ' AND trade_id > :id:';
			$filter['bind']['id'] = $id;
		}
		
		switch($order) {
			case self::ORDER_BY_PUB_TIME_DESC:
				$filter['order'] = 'pub_time DESC';
				break;
			case self::ORDER_BY_PUB_TIME_ASC:
				$filter['order'] = 'pub_time ASC';
				break;
			case self::ORDER_BY_PRICE_DESC:
				$filter['order'] = 'price DESC';
				break;
			case self::ORDER_BY_PRICE_ASC:
				$filter['order'] = 'price ASC';
				break;
		}
		
		$tradeList = Trade::find($filter);
		
		return $this->response->setJsonContent(array(
			'status' => 1,
			'data' => $tradeList->toArray()));
	}
	
	public function detailAction() {
		$trade = Trade::findFirstByTradeId($_GET['id']);
		
		if($trade == false || $trade->flag != Trade::FLAG_PUB) {
			return $this->response->setJsonContent(array(
				'status' => -1,
				'message' => '交易不存在'
				));
		}
		
		return $this->response->setJsonContent(array(
			'status' => 1,
			'data' => $trade->toArray()));
	}
	
	public function changeAction() {
		$changeAbleFlag = array(Trade::FLAG_PUB, Trade::FLAG_HIDE);
		
		$id = $this->request->getQuery('id', 'int');
		$flag = $this->request->getQuery('flag', 'int');
		
		if($id < 1 || !in_array($flag, $changeAbleFlag)) {
			return $this->response->setJsonContent(array(
				'status' => -1,
				'message' => '参数无效'));
		}
		
		$trade = Trade::findFirstByTradeId($_GET['id']);
		
		if($trade == false) {
			return $this->response->setJsonContent(array(
				'status' => -1,
				'message' => '交易不存在'
				));
		}
		
		if($trade->user_id != $this->member->user_id) {
			return $this->response->setJsonContent(array(
				'status' => -1,
				'message' => '无权访问此交易'));
		}
		
		if($trade->isEditable() == false) {
			return $this->response->setJsonContent(array(
				'status' => -1,
				'message' => '当前交易无法修改状态'));
		}
		
		$trade->flag = $flag;
		$is_succ = $trade->save();
		if($is_succ == false) {
			$errorMessage = join(',', $trade->getMessages());
			
			return $this->response->setJsonContent(array(
				'status' => -1, 
				'message' => $errorMessage));
		}
		
		return $this->response->setJsonContent(array(
			'status' => 1, 
			'message' => '交易状态修改成功'
			));
	}
	
	public function createAction() {
		$trade = new Trade();
		$trade->user_id = $this->member->user_id;
		$trade->username = $this->member->username;
		$trade->flag = Trade::FLAG_PUB;
		
		$tradeDetail = new TradeDetail();
		$tradeDetail->content = $this->request->getQuery('content', 'string');
		$trade->tradeDetail = $tradeDetail;
		
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
		$id = $this->request->getPost('id', 'int');
		
		
	}
	
}

/* End of file TradeController.php */