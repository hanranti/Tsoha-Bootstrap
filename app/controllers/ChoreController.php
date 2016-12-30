<?php

require 'app/models/Askare.php';

class ChoreController extends BaseController {

    public static function sandbox() {
        $chores = Askare::all();
        $chore = Askare::find(1);
        Kint::dump($chores);
        Kint::dump($chore);
    }

    public static function chore($id) {
        $chore = Askare::find($id);

        View::make('suunnitelmat/chore.html', array('chore' => $chore));
    }

}
