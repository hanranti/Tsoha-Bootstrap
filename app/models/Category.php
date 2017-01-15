<?php

class Category extends BaseModel {
    
    public $name;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }
    
    public static function allByUser($visitorid) {
        $query = DB::connection()->prepare(
        'SELECT * FROM Category WHERE name IN
        (SELECT category FROM ChoreCategory
        WHERE choreid IN (SELECT id FROM Chore
        WHERE visitorid = :visitorid))' );
        $query->execute(array('visitorid' => $visitorid));
        $rows = $query->fetchAll();
        
        $categories = array();
        
        foreach($rows as $row) {
            $categories[] = new Category(array(
            'name' => $row['name']));
        }
        
        return $categories;
    }
    
    public static function categoryExists($category) {
        $query = DB::connection()->prepare(
        'SELECT COUNT(*) as amount FROM Category
        WHERE name = :name');
        $query->execute(array(
        'name' => $category));
        $row = $query->fetch();
        if ($row['amount'] > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function save() {
        if (self::categoryExists($this->name)) {
            return;
        }
        $query = DB::connection()->prepare(
        'INSERT INTO Category (name)
        VALUES (:name)');
        $query->execute(array(
        'name' => $this->name));
        $query->fetch();
    }
    
    public function destroy() {
        $query = DB::connection() -> prepare(
        'DELETE FROM Category WHERE name = :name');
        $query->execute(array('name' => $this->name));
        $query->fetch();
    }
    
    public function validate_name() {
        $errors = array();
        
        if ($this->name == '' && $this->name == null)
            $errors[] = 'Luokan nimi ei saa olla tyhjä!';
        
        if (ctype_space($this->name))
            $errors[] = 'Luokan nimi ei saa koostua pelkistä tyhjämerkeistä';
        
        if (strlen($this->name) < 3)
            $errors[] = 'Luokan nimen tulee olla vähintään kolme merkkiä pitkä!';
        
        if (strlen($this->name) > 100)
            $errors[] = 'Luokan nimen tulee olla korkeintaan 100 merkkiä pitkä!';
        
        return $errors;
    }
    
}
?>