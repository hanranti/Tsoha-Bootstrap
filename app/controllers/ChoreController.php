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

        $chore = new Chore(array(
            'name' => $params['name'],
            'info' => $params['info'],
            'deadline' => $params['deadline'],
            'importancedegree' => $params['importancedegree']
        ));


        $errors = $chore->errors();

        if (count($errors) == 0) {
            $chore->save();
            Redirect::to('/chore/' . $chore->id, array('message' => 'Askare on lisätty tietokantaan'));
        } else {
            View::make('suunnitelmat/addChore.html', array('errors' => $errors));
        }
    }

    public function update() {
        
    }
}
