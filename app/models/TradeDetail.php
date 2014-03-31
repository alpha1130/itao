<?php
/**
 * TradeDetail.php
 * 
 * $Id$
 */
use \Phalcon\Mvc\Model\Message;

class TradeDetail extends \Phalcon\Mvc\Model {
	
	public $trade_id;
	
	public $content;
	
	public $extra;
	
	public function validation() {
		return $this->validationHasFailed() != true;
	}
	
	public function beforeSave() {
		$this->extra = serialize($this->extra);
	}
	
	public function beforeFetch() {
		$this->extra = unserialize($this->extra);
	}
	
}

/* End of file TradeDetail.php */