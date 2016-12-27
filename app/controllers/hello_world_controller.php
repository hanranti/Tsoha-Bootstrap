<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //echo 'Tämä on etusivu!';
        View::make("suunnitelmat/front.html");
    }

    public static function user() {
        View::make("suunnitelmat/user.html");
    }

    public static function chore() {
        View::make("suunnitelmat/chore.html");
    }

    public static function signup() {
        View::make("suunnitelmat/signup.html");
    }

    public static function logout() {
        View::make("suunnitelmat/logout.html");
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make("helloworld.html");
    }

}
