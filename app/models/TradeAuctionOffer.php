<?php
/**
 * TradeAuctionOffer.php
 * 
 * $Id$
 */

class TradeAuctionOffer extends Phalcon\Mvc\Model {
	
	public $offer_id;
	
	public $trade_id;
	
	public $auction_id;
	
	public $user_id;
	
	public $offer_time;
	
	public $offer_price;
	
	public $offer_flag;
	
	public $offer_memo;
	
	public function initialize() {
		$this->belongsTo('auction_id', 'TradeAuction', 'auction_id');
	}
	
}

/* End of file TradeAuctionOffer.php */