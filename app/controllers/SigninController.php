<?php

class SigninController extends BaseController {
    public static function signin() {

        View::make('suunnitelmat/signin.html');
    }
}