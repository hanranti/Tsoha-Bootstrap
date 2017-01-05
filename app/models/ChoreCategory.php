<?php

require 'app/models/Category.php';

class ChoreCategory extends BaseModel {

    public $id, $choreid, $category;

    public function _construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array();
    }

    public static function allByChore($choreid) {
        $query = DB::connection()->prepare('SELECT * FROM ChoreCategory WHERE choreid = :choreid');
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

}
