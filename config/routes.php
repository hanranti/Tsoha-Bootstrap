<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

$routes->get('/', function() {
    FrontController::front();
}
);
$routes->get('/user/:id', 'check_logged_in', function($id) {
    ChoreController::user($id);
}
);
$routes->get('/chore/:id', 'check_logged_in', function($id) {
    ChoreController::chore($id);
}
);
$routes->get('/chore/:id/edit', 'check_logged_in', function($id) {
    ChoreController::edit($id);
}
);
$routes->get('/addchore', 'check_logged_in', function() {
    ChoreController::add();
}
);
$routes->get('/signup', function() {
    UserController::signup();
}
);
$routes->get('/logout', function() {
    UserController::loggedout();
}
);
$routes->get('/signin', function() {
    UserController::signin();
}
);
$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
}
);
$routes->post('/user/:id', 'check_logged_in', function($id) {
    ChoreController::userOnlyCategory($id);
}
);
$routes->post('/addchore', 'check_logged_in', function() {
    ChoreController::store();
}
);
$routes->post('/chore/:id/edit', 'check_logged_in', function ($id) {
    ChoreController::update($id);
}
);
$routes->post('/chore/:id/addcategory', 'check_logged_in', function ($id) {
    ChoreController::addCategory($id);
}
);
$routes->post('/chore/:choreid/removecategory/:category', 'check_logged_in', function ($choreid, $category) {
    ChoreController::removeCategory($choreid, $category);
}
);
$routes->post('/destroychore/:choreid', 'check_logged_in', function ($choreid) {
    ChoreController::destroyChore($choreid);
}
);
$routes->post('/signin', function() {
    UserController::handle_signin();
}
);
$routes->post('/logout', function() {
    UserController::logout();
}
);
$routes->post('/signup', function() {
    UserController::handle_signup();
}
);
?>