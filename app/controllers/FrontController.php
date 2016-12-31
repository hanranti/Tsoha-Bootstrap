<?php

class FrontController extends BaseController {

    public static function front() {
        $userCount = Kayttaja::count();

        View::make('suunnitelmat/front.html', array(usercount => $userCount));
    }
}