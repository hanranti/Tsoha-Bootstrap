<?php

require 'app/models/Category.php';

class ChoreCategory extends BaseModel {
    
    public $id, $choreid, $category;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }
    
    public static function allByChore($choreid) {
        $query = DB::connection()->prepare(
        'SELECT * FROM ChoreCategory WHERE choreid = :choreid');
        $query->execute(array('choreid' => $choreid));
        $rows = $query->fetchAll();
        
        $categories = array();
        
        foreach ($rows as $row) {
            $categories[] = new Category(array(
            'name' => $row['category']
            ));
        }
        
        return $categories;
    }
    
    public static function countChores($category) {
        $query = DB::connection()->prepare(
        'SELECT COUNT(*) AS amount FROM ChoreCategory
        WHERE category = :category');
        $query->execute(array('category' => $category));
        $row = $query->fetch();
        return $row['amount'];
    }
    
    public function save() {
        $query = DB::connection()->prepare(
        'INSERT INTO ChoreCategory (choreid, category)
        VALUES (:choreid, :category)');
        $query->execute(array(
        'choreid' => $this->choreid, 'category' => $this->category->name));
        $query->fetch();
    }
    
    public function destroy() {
        $query = db::connection()->prepare(
        'DELETE FROM ChoreCategory WHERE category = :category');
        $query->execute(array(
        'category' => $this->category
        ));
        $query->fetch();
    }
}