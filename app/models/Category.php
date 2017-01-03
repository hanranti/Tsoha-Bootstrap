<?php

class Category extends BaseModel {

	public $name;
	
	public function _construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function find($name){
		
	}
}
