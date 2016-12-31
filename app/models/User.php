<?php

class User extends BaseModel {
	
	public function _construct($attributes) {
		parent::__construct($attributes);
	}
	
	public static function find($id) {
		$query = DB::connection()->prepare('SELECT * FROM User WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));
		$row = $query->fetch();
		
		if ($row) {
			$user = new User(array(
			                'id' => $row['id'],
			                'name' => $row['name'],
			                'password' => $row['password']
			            ));
			
			return $user;
		}
		
		return NULL;
	}
}
