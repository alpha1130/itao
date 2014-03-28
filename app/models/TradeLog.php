<?php
/**
 * TradeLog.php
 * 
 * $Id$
 */

class TradeLog extends Phalcon\Mvc\Model {
	
	public $log_id;
	
	public $trade_id;
	
	public $log_time;
	
	public $log_content;
	
	public function initialize() {
		$this->belongsTo('trade_id', 'Trade', 'trade_id');
	}
	
}

/* End of file TradeLog.php */