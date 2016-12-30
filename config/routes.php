<?php

$routes->get('/', function() {
    HelloWorldController::index();
});
$routes->get('/user', function() {
    HelloWorldController::user();
});
$routes->get('/chore/:id', function($id) {
    ChoreController::chore($id);
});
$routes->get('/signup', function() {
    HelloWorldController::signup();
});
$routes->get('/logout', function() {
    HelloWorldController::logout();
});
$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});
