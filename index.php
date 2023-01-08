<?php
session_start();
require __DIR__ . '/vendor/autoload.php';

use App\Config\Router;
use App\Controller\Home;
use App\Controller\User;
use App\Controller\Error;
use App\Controller\Dashboard;

// HOME CONTROLLER //
Router::get('/', function () {
    (new Home())->index();
});

Router::get('/login', function () {
    (new Home())->loginForm();
});

Router::get('/register', function () {
    (new Home())->registerForm();
});

Router::get('/about', function () {
    (new Home())->aboutView();
});

Router::get('/contact', function () {
    (new Home())->contactForm();
});


// USER CONTROLLER //
Router::post('/login/validate', function () {
    (new User())->loginValidate();
});

Router::post('/register/validate', function () {
    (new User())->registerValidate();
});

Router::get('/logout', function () {
    (new User())->logout();
});


// DASHBOARD CONTROLLER //
Router::get('/dashboard', function () {
    (new Dashboard())->index();
});

Router::get('/dashboard/users', function () {
    (new Dashboard())->usersView();
});

Router::get('/dashboard/users/modify', function () {
    (new Dashboard())->userModifyView();
});

Router::post('/dashboard/users/modify/validate', function () {
    (new Dashboard())->userModifyValidate();
});

Router::get('/dashboard/users/delete', function () {
    (new Dashboard())->userDelete();
});

//ERROR CONTROLLER //

Router::get('/404', function () {
    (new Error())->error404();
});
