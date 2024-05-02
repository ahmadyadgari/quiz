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

// Define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view->render('views/home-page.html');
});

// Survey Form
$f3->route('GET|POST /survey', function($f3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Extract and store data from POST
        $f3->set('SESSION.username', $_POST['username']);
        $f3->set('SESSION.statements', implode(", ", isset($_POST['statements']) ? $_POST['statements'] : []));

        // Reroute to summary page
        $f3->reroute('/summary');
    }

    // Render the survey page
    $view = new Template();
    echo $view->render('views/survey.html');
});

// Define a "summary" route
$f3->route('GET /summary', function($f3) {
    // Render the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

$f3->run();