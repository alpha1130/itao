<?php
/**
 * Category.php
 * 
 * $Id$
 */

class Category extends \Phalcon\Mvc\Model {
	
	const TYPE_NODE = 0;
	
	const TYPE_CATEGORY = 1;
	
	public $category_id;
	
	public $category_name;
	
	public $category_pid;
	
	public $category_type;
	
	public function initialize() {
		$this->hasMany('category_id', 'Category', 'category_pid');
	}
	
}

/* End of file Category.php */