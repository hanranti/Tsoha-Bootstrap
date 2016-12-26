<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //echo 'Tämä on etusivu!';
        View::make("suunniteltmat/default.html");
    } public static function user() {
        View::make("suunniteltmat/user.html");
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make("helloworld.html");
    }

}
