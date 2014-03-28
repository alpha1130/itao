<?php
/**
 * Order.php
 * 
 * $Id$
 */

class Order extends Phalcon\Mvc\Model {
	
	public $order_id;
	
	public $order_type;
	
	public $order_time;
	
	public $pk_id;
	
	public $user_id;
	
	public $order_amount;
	
	public $order_title;
	
	public $order_state;
	
	public $order_extra;
	
	public function initialize() {
		$this->hasMany('order_id', 'OrderDetail', 'order_id');
	}
	
}

/* End of file Order.php */