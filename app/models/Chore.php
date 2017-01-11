<?php

class Chore extends BaseModel {
    
    public $id, $name, $info, $deadline, $importancedegree, $visitorid;
    
    public function __construct($attributes) {
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
        $chores = array();
        
        foreach ($rows as $row) {
            $chores[] = new Chore(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'info' => $row['info'],
            'deadline' => $row['deadline'],
            'importancedegree' => $row['importancedegree'],
            'visitorid' => $row['visitorid']
            ));
        }
        
        return $chores;
    }
    
    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Chore');
        $query->execute();
        $rows = $query->fetchAll();
        
        $chores = array();
        
        foreach ($rows as $row) {
            $chores[] = Chore(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'info' => $row['info'],
            'deadline' => $row['deadline'],
            'importancedegree' => $row['importancedegree'],
            'visitorid' => $row['visitorid']
            ));
        }
        
        return $chores;
    }
    
    public static function allInCategoryByUser($category, $visitorid) {
        $query = DB::connection()->prepare(
        'SELECT * FROM Chore WHERE id IN
        (SELECT choreid FROM ChoreCategory
        WHERE category = :category) AND
        visitorid = :visitorid');
        $query->execute(array('category' => $category, 'visitorid' => $visitorid));
        $rows = $query->fetchAll();
        
        $chores = array();
        
        foreach ($rows as $row) {
            $chores[] = new Chore(array(
            'name' => $row['name'],
            'info' => $row['info'],
            'deadline' => $row['deadline'],
            'importancedegree' => $row['importancedegree'],
            'visitorid' => $row['visitorid']
            ));
        }

        return $chores;
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
        'INSERT INTO Chore (name, info, deadline, importancedegree, visitorid)
        VALUES (:name, :info, :deadline, :importancedegree, :visitorid) RETURNING id');
        $query->execute(array('name' => $this->name, 'info' => $this->info,
        'deadline' => $this->deadline, 'importancedegree' => $this->importancedegree,
        'visitorid' => $this->visitorid));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update($id) {
        $query = DB::connection()->prepare(
        'UPDATE Chore SET name = :name, info = :info, deadline = :deadline,
        importancedegree = :importancedegree, visitorid = :visitorid
        WHERE id = :id');
        $query->execute(array('id' => $id, 'name' => $this->name, 'info' => $this->info,
        'deadline' => $this->deadline, 'importancedegree' => $this->importancedegree,
        'visitorid' => $this->visitorid));
        $row = $query->fetch();
    }
    
    public function destroy() {
        $query = DB::connection()->prepare(
        'DELETE FROM Chore WHERE id = :id');
        $query->execute(array('id' => $this->id));
        $query->fetch();
    }
    
    public function validate_name() {
        $errors = array();
        
        if ($this->name == '' && $this->name == null)
            $errors[] = 'Nimi ei saa olla tyhjä!';
        
        
        if (strlen($this->name) < 3)
            $errors[] = 'Nimen tulee olla kolmea merkkiä pidempi!';
        
        if (strlen($this->name) > 100)
            $errors[] = 'Nimen tulee olla korkeintaan 100 merkkiä pitkä!';
        
        return $errors;
    }
    
    public function validate_info() {
        $errors = array();
        
        if ($this->info == '' && $this->info == null)
            $errors[] = 'Tiedot-kohta ei saa olla tyhjä!';
        
        
        if (strlen($this->name) < 3)
            $errors[] = 'Tietojen tulee olla kolmea merkkiä pidempi!';
        
        if (strlen($this->info) > 350)
            $errors[] = 'Tietojen tulee olla korkeintaan 350 merkkiä pitkä!';
        
        return $errors;
    }
    
    public function validate_deadline() {
        $errors = array();
        
        //vanha: /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$
        if (!preg_match("/^[0-9]{4}-(((01|03|05|07|08|10|12)-(0[1-9]|[1-2][0-9]|3[0-1]))|((04|06|09|11)-(0[1-9]|[1-2][0-9]|30))|(02-(0[1-9]|1[0-9]|2[0-8])))$/", $this->deadline))
        $errors[] = 'Deadlinen tulee olla päivämäärä muotoa YYYY-MM-DD!';
        
        return $errors;
    }
    
    public function validate_importancedegree() {
        $errors = array();
        
        if ($this->importancedegree == '' && $this->importancedegree == null)
            $errors[] = 'Tärkeysaste ei saa olla tyhjä!';
        
        if (!is_numeric($this->importancedegree))
            $errors[] = 'Tärkeysasteen tulee olla luku!';
        
        if ($this->importancedegree < 0)
            $errors[] = 'Tärkeysasteen tulee olla vähintään 0!';
        
        if ($this->importancedegree > 100)
            $errors[] = 'Tärkeysasteen tulee olla korkeintaan 100!';
        
        return $errors;
    }
    
}