<?php

require 'app/models/Kayttaja.php';
require 'app/models/Askare.php';

class UserController extends BaseController {
	public static function user($id){
		$user = Kayttaja::find($id);
		$chores = Askare::allByUser($id);
		
		View::make('suunnitelmat/user.html', array(
			'user' => $user,
			'chores' => $chores));
	}
}
