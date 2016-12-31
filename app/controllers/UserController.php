<?php

class UserController extends BaseController {
    public static function user($id){
        $user = User::find($id);

        View::make('suunnitelmat/user.html', array(user => $user));
    }
}