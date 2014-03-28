<?php
/**
 * TradeImage.php
 * 
 * $Id$
 */

class TradeImage extends Phalcon\Mvc\Model {
	
	const IMAGE_FLAG_TEMP = 0;
	
	const IMAGE_FLAG_INUSE = 1;
	
	const IMAGE_FLAG_DELETE = 2;
	
	public $image_id;
	
	public $user_id;
	
	public $upload_time;
	
	public $trade_id;
	
	public $image_path;
	
	public $image_name;
	
	public $image_flag;
	
	public function initialize() {
		$this->belongsTo('trade_id', 'Trade', 'trade_id');
	}
	
}

/* End of file TradeImage.php */