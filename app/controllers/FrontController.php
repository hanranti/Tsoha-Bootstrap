<?php

require 'app/models/Kayttaja.php';
require 'app/models/Askare.php';

class FrontController extends BaseController {

    public static function front() {
        $userCount = Kayttaja::count();
        $choreCount = Askare::count();

        View::make('suunnitelmat/front.html', array(
            'userCount' => $userCount,
            'choreCount' => $choreCount
        ));
    }
}