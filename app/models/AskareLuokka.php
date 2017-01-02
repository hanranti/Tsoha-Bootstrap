<?php

require 'app/models/Luokka.php';

class AskareLuokka extends BaseModel {

    public $id, $askareid, $luokka;

    public function _construct($attributes) {
		parent::__construct($attributes);
	}

    public static function allByChore($askareid) {
        $query = DB::connection()->prepare('SELECT * FROM AskareLuokka WHERE askareid = :askareid');
        $query->execute(array('askareid' => $askareid));
        $rows = $query->fetchAll();

        $classes = array();

        foreach ($rows as $row) {
            $classes[] = new Luokka(array(
                'name' => $row['luokka']
            ));
        }

        return $classes;
    }
}