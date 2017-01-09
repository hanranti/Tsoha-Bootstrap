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
    HelloWorldController::signup();
}
);
$routes->get('/logout', function() {
    HelloWorldController::logout();
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
$routes->post('/user/:userid/destroychore/:choreid', 'check_logged_in', function ($userid, $choreid) {
    ChoreController::destroyChore($userid, $choreid);
}
);
$routes->post('/signin', function() {
    UserController::handle_signin();
}
);