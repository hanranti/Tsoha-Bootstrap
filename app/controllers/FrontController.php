<?php

require 'app/models/Visitor.php';
require 'app/models/Chore.php';

class FrontController extends BaseController {

    public static function front() {
        $userCount = Visitor::count();
        $choreCount = Chore::count();

        View::make('front.html', array(
            'userCount' => $userCount,
            'choreCount' => $choreCount
        ));
    }
}