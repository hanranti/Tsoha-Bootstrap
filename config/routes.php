<?php

$routes->get('/', function() {
    FrontController::front();
}
);
$routes->get('/user/:id', function($id) {
    UserController::user($id);
}
);
$routes->get('/chore/:id', function($id) {
    ChoreController::chore($id);
}
);
$routes->get('/chore/:id/edit', function($id) {
    ChoreController::edit($id);
}
);
$routes->get('/addchore', function() {
    ChoreController::add();
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
}
);
$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
}
);
$routes->post('/addchore', function() {
    ChoreController::store();
}
);
$routes->post('/chore/:id/edit', function ($id) {
    ChoreController::update();
}
);
