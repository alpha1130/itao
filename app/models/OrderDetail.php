<?php
/**
 * OrderDetail.php
 * 
 * $Id$
 */

class OrderDetail extends Phalcon\Mvc\Model {
	
	public $detail_id;
	
	public $order_id;
	
	public $detail_type;
	
	public $detail_amount;
	
	public $detail_title;
	
	public $create_time;
	
	public function initialize() {
		$this->belongsTo('order_id', 'Order', 'order_id');
	}
	
}

/* End of file OrderDetail.php */