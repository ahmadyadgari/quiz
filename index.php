<?php

// 328/Week5/quiz/index.php
// This is my CONTROLLER!

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once ('vendor/autoload.php');

// Instantiate the F3 Base class
$f3 = Base::instance();

// Define a default route
// https://ayadgari.greenriverdev.com/328/Week5/quiz/

$f3->route('GET /', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');

});

// Survey Form
$f3->route('GET|POST /survey', function($f3) {

    $view = new Template();
    echo $view->render('views/survey.html');
});

// Summary Page
$f3->route('GET /summary', function() {

    // Render a view page
    $view = new Template();
    echo $view->render('views/summary.html');
});


// Run Fat-Free
$f3->run();