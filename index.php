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
    // echo "<p>Hello world!</p>";

    // Render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');

});

// Survey Form
$f3->route('GET|POST /survey', function($f3) {

    //Check if the form has been posted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Get the data
        $petData = [
            'petType' => $f3->get('POST.petType'),
            'breedType' => $f3->get('POST.breedType'),
            'petAge' => $f3->get('POST.petAge'),
            'petColor' => $f3->get('POST.petColor'),
            'petGender' => $f3->get('POST.petGender')
        ];

        //Validate the data
        if (empty($petData)) {

            //Data is invalid
            echo "Please supply a pet type";
        } else {
            //Data is valid
            $f3->set('SESSION.petData', $petData);

            //Redirect to the summary route
            $f3->reroute("summary");
        }
    }
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