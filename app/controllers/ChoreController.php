<?php

require 'app/models/Chore.php';
require 'app/models/ChoreCategory.php';

class ChoreController extends BaseController {
    
    public static function sandbox() {
        $chores = Chore::all();
        $chore = Chore::find(1);
        Kint::dump($chores);
        Kint::dump($chore);
        
        View::make('helloworld.html');
    }
    
    public static function chore($id) {
        $chore = Chore::find($id);
        $categories = ChoreCategory::allByChore($id);
        
        View::make('suunnitelmat/chore.html', array(
        'chore' => $chore,
        'categories' => $categories));
    }
    
    public static function edit($id) {
        $chore = Chore::find($id);
        $categories = ChoreCategory::allByChore($id);
        View::make('suunnitelmat/editChore.html', array(
        'chore' => $chore,
        'categories' => $categories));
    }
    
    public static function add() {
        View::make('suunnitelmat/addChore.html', array());
    }
    
    public static function store() {
        $params = $_POST;
        
        $attributes = array(
        'name' => $params['name'],
        'info' => $params['info'],
        'deadline' => $params['deadline'],
        'importancedegree' => $params['importancedegree']
        );
        
        $chore = new Chore($attributes);
        
        $errors = $chore->errors();
        
        if (count($errors) == 0) {
            $chore->save();
            Redirect::to('/chore/' . $chore->id, array('message' => 'Askare on lisätty tietokantaan'));
        } else {
            View::make('suunnitelmat/addChore.html', array('errors' => $errors));
        }
    }
    
    public function update($id) {
        $params = $_POST;
        
        $attributes = array(
        'name' => $params['name'],
        'info' => $params['info'],
        'deadline' => $params['deadline'],
        'importancedegree' => $params['importancedegree']
        );
        
        $chore = new Chore($attributes);
        
        $errors = $chore->errors();
        
        if (count($errors) == 0) {
            $chore->update($id);
            Redirect::to('/chore/' . $id, array('message' => 'Askareen tiedot päivitettiin'));
        } else {
            View::make('suunnitelmat/addChore.html', array('errors' => $errors));
        }
    }
    public function addCategory($choreid) {
        $params = $_POST;
        
        $category = $params['category'];
        
        $category = new Category(array(
        'name' => $category
        ));
        
        $choreCategory = new ChoreCategory(array(
        'choreid' => $choreid,
        'category' => $category
        ));
        
        $errors = $category->errors();
        $errors = array_merge($errors, $choreCategory->errors());
        
        if (count($errors) == 0) {
            $category->save();
            $choreCategory->save();
            Redirect::to('/chore/' . $choreid, array('message' => 'Askare lisättiin luokkaan!'));
        } else {
            View::make('suunnitelmat/editChore.html', array('errors' => $errors));
        }
    }
    
    public function removeCategory($choreid) {
        $params = $_POST;
        
        $category = $params['category'];
        
        $category = new Category(array(
        'name' => $category
        ));
        
        $choreCategory = new ChoreCategory(array(
        'choreid' => $choreid,
        'category' => $category
        ));
        
        $choreCategory->destroy();
        if(ChoreCategory::countChores($category['name']) == 0) {
            $category->destroy();
        }
        Redirect::to('/chore/' . $choreid, array('message' => 'Askare poistettiin luokasta'));
    }
}