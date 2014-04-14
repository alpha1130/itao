<?php
/**
 * Trade.php
 *
 * $Id$
 */
use Phalcon\Mvc\Model,
	Phalcon\Mvc\Model\Message;

class Trade extends Model {

	const MODE_OVERSELL = 1;

	const MODE_AUCTION = 2;

	const MODE_EXCHANGE = 3;
	
	const FLAG_DRAFT = 0;
	
	const FLAG_PUB = 1;
	
	const FLAG_HIDE = 2;
	
	const FLAG_DELETE = 3;
	
	const FLAG_TRADING = 4;
	
	const FLAG_FINISH = 5;

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
		$this->hasOne('category', 'Category', 'category_id');
		$this->hasMany('trade_id', 'TradeAuction', 'trade_id');
		$this->hasMany('trade_id', 'TradeLog', 'trade_id');
		$this->hasMany('trade_id', 'TradeImage', 'trade_id');
	}

	public function beforeValidationOnCreate() {
		$this->create_time = $_SERVER['REQUEST_TIME'];
		$this->pub_time = 0;
		$this->modify_time = 0;
	}

	public function validation() {
		$title_len = mb_strlen($this->title, 'utf-8');
		if($title_len < 5 || $title_len > 30) {
			$this->appendMessage(new Message(
				'标题不能必须介于5-30个字符',
				'title'));
		}
		
		if($this->mode == null || 
			!in_array($this->mode, array(
				self::MODE_OVERSELL, 
				self::MODE_AUCTION, 
				self::MODE_EXCHANGE))) {
			$this->appendMessage(new Message(
				'交易模式无效',
				'mode'));
		}
		
		if($this->category < 1) {
			$this->appendMessage(new Message(
				'分类无效',
				'category'));
		}
		$category = Category::findFirstByCategoryId($this->category);
		if($category->category_type != Category::TYPE_NODE) {
			$this->appendMessage(new Message(
				'分类不存在',
				'category'));
		}
		
		return $this->validationHasFailed() != true;
	}
	
	/**
	 * @return boolean
	 */
	public function isEditable() {
		if($this->trade_id < 1) {
			return false;
		}
		
		$changeAbleFlag = array(
			self::FLAG_PUB, 
			self::FLAG_HIDE);
		
		if(!in_array($this->flag, $changeAbleFlag)) {
			return false;
		}
		
		return true;
	}

}

/* End of file Trade.php */