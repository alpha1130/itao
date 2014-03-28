<?php
/**
 * BalanceLog.php
 * 
 * $Id$
 */

class BalanceLog extends Phalcon\Mvc\Model {
	
	const ACTION_ORDER_PAY = 1;
	
	const ACTION_WITHDRAW = 2;
	
	public $log_id;
	
	public $order_id;
	
	public $user_id;
	
	public $action;
	
	public $create_time;
	
	public $memo;
	
	public function initialize() {
		$this->hasOne('order_id', 'Order', 'order_id');
	}
	
}

/* End of file BalanceLog.php */