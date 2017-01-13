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
        
        if ($chore == null || !self::isAuthorized($chore->visitorid)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        View::make('chores/chore.html', array(
        'chore' => $chore,
        'categories' => $categories));
    }
    
    public static function user($id) {
        
        if (!self::isAuthorized($id)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        $user = Visitor::find($id);
        $chores = Chore::allByUser($id);
        $categories = Category::allByUser($id);
        
        View::make('chores/user.html', array(
        'user' => $user,
        'chores' => $chores,
        'categories' => $categories));
    }
    
    public static function userOnlyCategory($userid) {
        $params = $_POST;
        
        if (!self::isAuthorized($userid)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        $category = $params['category'];
        $user = Visitor::find($userid);
        $chores = Chore::allInCategoryByUser($category, $userid);
        $categories = Category::allByUser($userid);
        
        Redirect::to('/user/' . $userid, array(
        'user' => $user,
        'chores' => $chores,
        'categories' => $categories));
    }
    
    public static function edit($id) {
        $chore = Chore::find($id);
        $categories = ChoreCategory::allByChore($id);
        
        if ($chore == null || !self::isAuthorized($chore->visitorid)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        View::make('chores/editChore.html', array(
        'chore' => $chore,
        'categories' => $categories));
    }
    
    public static function add() {
        View::make('chores/addChore.html', array());
    }
    
    public static function store() {
        $params = $_POST;
        
        $user = self::get_user_logged_in();
        
        $attributes = array(
        'name' => $params['name'],
        'info' => $params['info'],
        'deadline' => $params['deadline'],
        'importancedegree' => $params['importancedegree'],
        'visitorid' => $user->id
        );
        
        $chore = new Chore($attributes);
        
        $errors = $chore->errors();
        
        if (count($errors) == 0) {
            $chore->save();
            Redirect::to('/chore/' . $chore->id, array('message' => 'Askare on lisätty tietokantaan'));
        } else {
            View::make('chores/addChore.html', array(
            'errors' => $errors,
            'chore' => $chore));
        }
    }
    
    public function update($id) {
        $params = $_POST;
        
        $chore = Chore::find($id);
        
        if ($chore == null || !self::isAuthorized($chore->visitorid)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        $attributes = array(
        'name' => $params['name'],
        'info' => $params['info'],
        'deadline' => $params['deadline'],
        'importancedegree' => $params['importancedegree']
        );
        
        $chore = new Chore($attributes);
        
        $categories = ChoreCategory::allByChore($id);
        
        $errors = $chore->errors();
        
        if (count($errors) == 0) {
            $chore->update($id);
            Redirect::to('/chore/' . $id, array(
            'message' => 'Askareen tiedot päivitettiin'));
        } else {
            $chore->id = $id;
            View::make('chores/editChore.html', array(
            'errors' => $errors,
            'chore' => $chore,
            'categories' => $categories));
        }
    }
    
    public function addCategory($choreid) {
        $params = $_POST;
        
        if (!self::isAuthorized(Chore::find($choreid)->visitorid)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        $category = $params['category'];
        
        $category = new Category(array(
        'name' => $category
        ));
        
        $choreCategory = new ChoreCategory(array(
        'choreid' => $choreid,
        'category' => $category->name
        ));
        
        $errors = $category->errors();
        $errors = array_merge($errors, $choreCategory->errors());
        
        if (count($errors) == 0) {
            $category->save();
            $choreCategory->save();
            Redirect::to('/chore/' . $choreid, array('message' => 'Askare lisättiin luokkaan!'));
        } else {
            View::make('chores/editChore.html', array('errors' => $errors));
        }
    }
    
    public function removeCategory($choreid, $category) {
        
        if (!self::isAuthorized(Chore::find($choreid)->visitorid)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        $category = new Category(array(
        'name' => $category
        ));
        
        $choreCategory = new ChoreCategory(array(
        'choreid' => $choreid,
        'category' => $category
        ));
        
        $choreCategory->destroy();
        if (ChoreCategory::countChores($category) == 0) {
            $category->destroy();
        }
        Redirect::to('/chore/' . $choreid, array('message' => 'Askare poistettiin luokasta!'));
    }
    
    public function destroyChore($choreid) {
        
        if (!self::isAuthorized(Chore::find($choreid)->visitorid)) {
            Redirect::to('/', array('message' => 'Ei käyttöoikeutta!'));
        }
        
        $chore = new Chore(array(
        'id' => $choreid
        ));
        ChoreCategory::destroyAllByChore($choreid);
        $chore->destroy();
        Redirect::to('/user/' . self::get_user_logged_in()->id, array('message' => 'Askare poistettiin!'));
    }
    
}