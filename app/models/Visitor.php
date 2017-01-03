<?php

class Visitor extends BaseModel {
	
	public $id, $name, $password;
	
	public function _construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Visitor WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		
		if ($row) {
			$visitor = new Visitor(array(
									                'id' => $row['id'],
									                'name' => $row['name'],
													'password' => ''
									            ));
			
			return $visitor;
		}
		
		return NULL;
	}
	
	public static function count(){
		$query = DB::connection()->prepare('SELECT COUNT(*) AS amount FROM Visitor LIMIT 1');
		$query->execute();
		$row = $query->fetch();
		
		if ($row) {
			$count = $row['amount'];
			
			return $count;
		}
		
		return NULL;
	}
}
