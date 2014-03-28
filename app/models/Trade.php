<?php
/**
 * Trade.php
 * 
 * $Id$
 */

class Trade extends \Phalcon\Mvc\Model {
	
	public $trade_id;
	
	public $title;
	
	public $mode;
	
	public $category;
	
	public $create_time;
	
	public $pub_time;
	
	public $modify_time;
	
	public $price;
	
	public $user_id;
	
	public $username;
	
	public $preview_image;
	
	public $flag;
	
	public function initialize() {
		$this->hasOne('trade_id', 'TradeDetail', 'trade_id');
		$this->hasMany('trade_id', 'TradeAuction', 'trade_id');
		$this->hasMany('trade_id', 'TradeLog', 'trade_id');
		$this->hasMany('trade_id', 'TradeImage', 'trade_id');
	}
	
}

/* End of file Trade.php */