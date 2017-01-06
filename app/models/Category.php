<?php

class Category extends BaseModel {

    public $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }

    public static function find($name) {
        
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
