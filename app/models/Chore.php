<?php

class Chore extends BaseModel {

    public $id, $name, $info, $deadline, $importancedegree, $kayttaja;

    public function _construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_info', 'validate_deadline', 'validate_importancedegree');
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Chore WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $Chore = new Chore(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'info' => $row['info'],
                'deadline' => $row['deadline'],
                'importancedegree' => $row['importancedegree'],
                'visitorid' => $row['visitorid']
            ));

            return $Chore;
        }

        return NULL;
    }

    public static function allByUser($visitorid) {
        $query = DB::connection()->prepare('SELECT * FROM Chore WHERE visitorid = :visitorid');
        $query->execute(array('visitorid' => $visitorid));
        $rows = $query->fetchAll();
        $Choreet = array();

        foreach ($rows as $row) {
            $Choreet[] = new Chore(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'info' => $row['info'],
                'deadline' => $row['deadline'],
                'importancedegree' => $row['importancedegree'],
                'visitorid' => $row['visitorid']
            ));
        }

        return $Choreet;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Chore');
        $query->execute();
        $rows = $query->fetchAll();
        $Choreet = array();

        foreach ($rows as $row) {
            $Choreet[] = Chore(array(
                'id' => $row['id'],
                'name' => $row['kayttaja'],
                'info' => $row['info'],
                'deadline' => $row['deadline'],
                'importancedegree' => $row['importancedegree'],
                'visitorid' => $row['visitorid']
            ));
        }

        return $Choreet;
    }

    public static function count() {
        $query = DB::connection()->prepare('SELECT COUNT(*) AS amount FROM Chore LIMIT 1');
        $query->execute();
        $row = $query->fetch();

        if ($row) {
            $count = $row['amount'];

            return $count;
        }

        return NULL;
    }

    public function save() {
        $query = DB::connection()->prepare(
                'INSERT INTO Chore (name, info, deadline, importancedegree) 
		VALUES (:name, :info, :deadline, :importancedegree) RETURNING id');
        $query->execute(array('name' => $this->name, 'info' => $this->info,
            'deadline' => $this->deadline, 'importancedegree' => $this->importancedegree));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function validate_name() {
        $errors = array();

        if ($this->name == '' && $this->name == null)
            $errors[] = 'Nimi ei saa olla tyhjä!';


        if (strlen($this->name) < 3)
            $errors[] = 'Nimen tulee olla kolmea merkkiä pidempi!';


        return $errors;
    }

    public function validate_info() {
        $errors = array();

        if ($this->info == '' && $this->info == null)
            $errors[] = 'Tiedot-kohta ei saa olla tyhjä!';


        if (strlen($this->name) < 3)
            $errors[] = 'Tietojen tulee olla kolmea merkkiä pidempi!';


        return $errors;
    }

    public function validate_deadline() {
        $errors = array();

        if (!preg_match("[0-1][0-9]{3}-[0-2][0-9]-[0-3][0-9]", $this->deadline))
            $errors[] = 'Deadlinen tulee olla päivämäärä muotoa YYYY-MM-DD!';

        return $errors;
    }

    public function validate_importancedegree() {
        $errors = array();

        if ($this->importancedegree == '' && $this->importancedegree == null)
            $errors[] = 'Tärkeysaste ei saa olla tyhjä!';

        if (!is_numeric($this->importancedegree))
            $errors[] = 'Tärkeysasteen tulee olla luku!';


        return $errors;
    }

}
