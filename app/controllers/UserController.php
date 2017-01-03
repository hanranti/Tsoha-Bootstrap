<?php

require 'app/models/Visitor.php';
require 'app/models/Chore.php';

class UserController extends BaseController {
	public static function user($id){
		$user = Visitor::find($id);
		$chores = Chore::allByUser($id);
		
		View::make('suunnitelmat/user.html', array(
			'user' => $user,
			'chores' => $chores));
	}
}
