<?php

class Kayttaja extends BaseModel {
	
	public $id, $name, $password;
	
	public function _construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		
		if ($row) {
			$user = new Kayttaja(array(
									                'id' => $row['id'],
									                'name' => $row['name'],
													'password' => ''
									            ));
			
			return $user;
		}
		
		return NULL;
	}
	
	public static function count(){
		$query = DB::connection()->prepare('SELECT COUNT(*) AS maara FROM Kayttaja LIMIT 1');
		$query->execute();
		$row = $query->fetch();
		
		if ($row) {
			$count = $row['maara'];
			
			return $count;
		}
		
		return NULL;
	}
}
