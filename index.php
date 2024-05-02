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

// Survey Form - handling both display and processing
$f3->route('GET|POST /survey', function($f3) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate the data (check if username is filled and statements are an array)
        $isValid = !empty($_POST['username']) && isset($_POST['statements']) && is_array($_POST['statements']);

        if (!$isValid) {
            // Data is invalid
            echo "Please fill in your name and select at least one statement.";
        } else {
            // Data is valid, store submitted data in the session
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['statements'] = $_POST['statements'];

            // Redirect to the summary page
            $f3->reroute('/summary');
        }
    } else {
        // Display the survey form on GET request
        $view = new Template();
        echo $view->render('views/survey.html');
    }
});

// Summary Page - display the data from session
$f3->route('GET /summary', function($f3) {
    // Check if session data is available and set it to F3 hive
    if (isset($_SESSION['username']) && isset($_SESSION['statements'])) {
        $f3->set('username', $_SESSION['username']);
        $f3->set('statements', $_SESSION['statements']);
    } else {
        // Default values if session data is not set
        $f3->set('username', 'Unknown');
        $f3->set('statements', []);
    }

    $view = new Template();
    echo $view->render('views/summary.html');
});

// Run Fat-Free
$f3->run();