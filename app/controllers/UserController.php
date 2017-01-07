<?php

require 'app/models/Visitor.php';
require 'app/models/Chore.php';

class UserController extends BaseController {
    
    public static function signin() {
        View::make('suunnitelmat/signin.html');
    }
    
    public static function handle_signin() {
        $params = $_POST;
        
        $user = Visitor::authenticate($params['name'], $params['password']);
        
        if(!$user){
            View::make('suunnitelmat/signin.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
        }else{
            $_SESSION['user'] = $user->id;
            
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
        }
    }
}