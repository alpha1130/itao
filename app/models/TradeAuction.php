<?php
/**
 * TradeAuction.php
 * 
 * $Id$
 */

class TradeAuction extends Phalcon\Mvc\Model {
	
	public $auction_id;
	
	public $trade_id;
	
	public $create_time;
	
	public function initialize() {
		$this->belongsTo('trade_id', 'Trade', 'trade_id');
		$this->hasMany('auction_id', 'TradeAuctionOffer', 'auction_id');
	}
	
}

/* End of file TradeAuction.php */