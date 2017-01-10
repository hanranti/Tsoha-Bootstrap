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

}
