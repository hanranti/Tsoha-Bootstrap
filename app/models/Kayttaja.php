<?php

class Kayttaja extends BaseModel {
	
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
			                'name' => $row['name']
			            ));
			
			return $user;
		}
		
		return NULL;
	}

	public static function count(){
		$query = DB::connection()->prepare('SELECT COUNT(*) AS Maara FROM Kayttaja');
		$query->execute();
		$row = $query->fetch();

		if ($row) {
			$count = $row['Maara'];

			return $count;
		}

		return NULL;
	}
}
