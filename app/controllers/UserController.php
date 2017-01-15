<?php

require 'app/models/Visitor.php';
require 'app/models/Chore.php';

class UserController extends BaseController {
    
    public static function signin() {
        View::make('user/signin.html');
    }
    
    public static function signup() {
        View::make("user/signup.html");
    }
    
    public static function handle_signin() {
        $params = $_POST;
        
        $user = Visitor::authenticate($params['name'], $params['password']);
        
        if (!$user) {
            View::make('user/signin.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
        } else {
            $_SESSION['user'] = $user->id;
            
            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
        }
    }
    
    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/logout');
    }
    
    public static function loggedout() {
        View::make('user/logout.html');
    }
    
    public static function handle_signup() {
        $params = $_POST;
        
        $errors = array();
        if ($params['password1'] != $params['password2'])
            $errors[] = 'Salasanojen tulee olla samoja!';
        if (Visitor::nameExists($params['name']))
            $errors[] = 'Käyttäjätunnus on jo käytössä!';
        
        $user = new Visitor(array(
        'name' => $params['name'],
        'password' => $params['password1']));
        
        $errors = array_merge($errors, $user->errors());
        
        if (count($errors) == 0) {
            $user->save();
            Redirect::to('/signin');
        } else {
            View::make('user/signup.html', array('errors' => $errors));
        }
    }
}
?>