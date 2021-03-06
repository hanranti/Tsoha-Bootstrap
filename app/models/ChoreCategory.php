<?php

require 'app/models/Category.php';

class ChoreCategory extends BaseModel {
    
    public $id, $choreid, $category;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_all');
    }
    
    public static function allByChore($choreid) {
        $query = DB::connection()->prepare(
        'SELECT * FROM ChoreCategory WHERE choreid = :choreid');
        $query->execute(array('choreid' => $choreid));
        $rows = $query->fetchAll();
        
        $categories = array();
        
        foreach ($rows as $row) {
            $categories[] = new Category(array(
            'name' => $row['category']));
        }
        
        return $categories;
    }
    
    public static function allByChoreByUser($visitorid) {
        $query = DB::connection()->prepare(
        'SELECT id FROM Chore WHERE visitorid = :visitorid');
        $query->execute(array('visitorid' => $visitorid));
        $rows = $query->fetchAll();
        
        $categoriesByChore = array();
        
        foreach($rows as $row) {
            $categoriesByChore[] = ChoreCategory::allByChore($row['id']);
        }
        
        return $categoriesByChore;
    }
    
    public static function countChores($category) {
        $query = DB::connection()->prepare(
        'SELECT COUNT(*) AS amount FROM ChoreCategory
        WHERE category = :category');
        $query->execute(array('category' => $category->name));
        $row = $query->fetch();
        return $row['amount'];
    }
    
    public static function choreCategoryExists($cid, $categoryname) {
        $query = DB::connection()->prepare(
        'SELECT COUNT(*) AS amount FROM ChoreCategory
        WHERE choreid = :cid AND category = :categoryname');
        $query->execute(array(
        'cid' => $cid,
        'categoryname' => $categoryname));
        $row = $query->fetch();
        if ($row['amount'] > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function save() {
        $query = DB::connection()->prepare(
        'INSERT INTO ChoreCategory (choreid, category)
        VALUES (:choreid, :category)');
        $query->execute(array(
        'choreid' => $this->choreid, 'category' => $this->category));
        $query->fetch();
    }
    
    public function destroy() {
        $query = DB::connection()->prepare(
        'DELETE FROM ChoreCategory WHERE choreid = :choreid
        AND category = :category');
        $query->execute(array(
        'choreid' => $this->choreid,
        'category' => $this->category));
        $query->fetch();
    }
    
    public function destroyAllByChore($choreid) {
        $query = DB::connection()->prepare(
        'DELETE FROM ChoreCategory WHERE choreid = :choreid');
        $query->execute(array(
        'choreid' => $choreid));
        $query->fetch();
    }
    
    public function validate_all() {
        $errors = array();
        
        if (self::choreCategoryExists($this->choreid, $this->category))
            $errors[] = 'Askare kuuluu jo tähän luokkaan!';
        
        return $errors;
    }
    
}
?>