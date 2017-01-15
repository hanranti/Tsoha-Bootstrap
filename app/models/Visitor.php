<?php

class Visitor extends BaseModel {
    
    public $id, $name, $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_password');
    }
    
    public static function authenticate($username, $pw) {
        $query = DB::connection()->prepare('SELECT * FROM Visitor
        WHERE name = :username AND password = :pw LIMIT 1');
        $query->execute(array('username' => $username, 'pw' => $pw));
        $row = $query->fetch();
        if($row){
            return new Visitor(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'password' => ''));
        }else{
            return null;
        }
    }
    
    public static function find($id) {
        $query = DB::connection()->prepare(
        'SELECT * FROM Visitor WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if ($row) {
            $visitor = new Visitor(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'password' => ''));
            
            return $visitor;
        }
        
        return NULL;
    }
    
    public static function nameExists($name) {
        $query = DB::connection()->prepare(
        'SELECT COUNT(*) AS amount FROM Visitor WHERE name = :name');
        $query->execute(array('name' => $name));
        $row = $query->fetch();
        
        if ($row['amount'] > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function count() {
        $query = DB::connection()->prepare(
        'SELECT COUNT(*) AS amount FROM Visitor LIMIT 1');
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
        'INSERT INTO Visitor (name, password)
        VALUES (:name, :password)');
        $query->execute(array(
        'name' => $this->name,
        'password' => $this->password));
        $query->fetch();
    }
    
    public function validate_name() {
        $errors = array();
        
        if ($this->name == '' && $this->name == null)
            $errors[] = 'Käyttäjätunnus ei saa olla tyhjä!';
        
        if (ctype_space($this->name))
            $errors[] = 'Käyttäjätunnus ei saa koostua pelkistä tyhjämerkeistä!';
        
        if (strlen($this->name) < 3)
            $errors[] = 'Käyttäjätunnuksen tulee olla vähintään kolme merkkiä pitkä!';
        
        if (strlen($this->name) > 100) {
            $errors[] = 'Käyttäjätunnuksen tulee olla korkeintaan 100 merkkiä pitkä!';
        }
        
        return $errors;
    }
    
    public function validate_password () {
        $errors = array();
        
        if ($this->password == '' && $this->name == null)
            $errors[] = 'Salasana ei saa olla tyhjä!';
        
        if (strlen($this->password) < 3)
            $errors[] = 'Salasanan tulee olla vähintään kolme merkkiä pitkä!';
        
        if (strlen($this->password) > 100) {
            $errors[] = 'Salasanan tulee olla korkeintaan 100 merkkiä pitkä!';
        }
        
        return $errors;
    }
}
?>