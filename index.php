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
        // Extract data from POST
        $username = $_POST['username'];
        $statements = isset($_POST['statements']) ?
            implode(", ", $_POST['statements']) : "None selected";

        // Store data
        $f3->set('SESSION.username', $username);
        $f3->set('SESSION.statements', $statements);

        // Redirect to the summary page
        $f3->reroute('/summary');
    } else {
        // Display the survey form
        $view = new Template();
        echo $view->render('views/survey.html');
    }
});

// Summary Page
$f3->route('GET /summary', function($f3) {
    // Check if
    if (!$f3->exists('SESSION.username') || !$f3->exists('SESSION.statements')) {
        // Redirect to the home page if no session data found
        $f3->reroute('/');
    }

    // Render the summary
    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();