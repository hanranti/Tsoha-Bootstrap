<?php

require 'app/models/Askare.php';
require 'app/models/AskareLuokka.php';

class ChoreController extends BaseController {
	
	public static function sandbox() {
		$chores = Askare::all();
		$chore = Askare::find(1);
		Kint::dump($chores);
		Kint::dump($chore);
	}
	
	public static function chore($id) {
		$chore = Askare::find($id);
		$classes = AskareLuokka::allByChore($id);
		
		View::make('suunnitelmat/chore.html', array(
		            'chore' => $chore,
		             'classes' => $classes));
	}
	
}
