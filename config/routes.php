<?php

$routes->get('/', function() {
	FrontController::front();
}
);
$routes->get('/user:id', function($id) {
	UserController::user($id);
}
);
$routes->get('/chore/:id', function($id) {
	ChoreController::chore($id);
}
);
$routes->get('/signup', function() {
	HelloWorldController::signup();
}
);
$routes->get('/logout', function() {
	HelloWorldController::logout();
}
);
$routes->get('/signin', function() {
	SigninController::signin();
});
$routes->get('/hiekkalaatikko', function() {
	HelloWorldController::sandbox();
}
);
