<?php

class Category extends BaseModel {
    
    public $name;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }
    
    public function save() {
        $query = DB::connection()->prepare(
        'SELECT COUNT(*) as amount FROM Category
        WHERE name = :name');
        $query->execute(array(
        'name' => $this->name));
        $row = $query->fetch();
        if ($row['amount'] > 0) {
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
            $errors[] = 'Nimi ei saa olla tyhjä!';
        
        
        if (strlen($this->name) < 3)
            $errors[] = 'Nimen tulee olla kolmea merkkiä pidempi!';
        
        
        return $errors;
    }
    
}