<?php

$routes->get('/', function() {
    FrontController::front();
}
);
$routes->get('/user/:id', function($id) {
    ChoreController::user($id);
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
    UserController::signin();
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
    ChoreController::update($id);
}
);
$routes->post('/chore/:id/addcategory', function ($id) {
    ChoreController::addCategory($id);
}
);
$routes->post('/chore/:choreid/removecategory/:category', function ($choreid, $category) {
    ChoreController::removeCategory($choreid, $category);
}
);
$routes->post('/user/:userid/destroychore/:choreid', function ($userid, $choreid) {
    ChoreController::destroyChore($userid, $choreid);
}
);
$routes->post('/signin', function() {
    UserController::handle_signin();
}
);