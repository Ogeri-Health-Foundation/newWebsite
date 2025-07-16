<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../Middleware/GlobalAuth.php";
require_once "../Controllers/update_event.controller.php";
require_once "../Models/UpdateEvents.php";

header("Content-Type: application/json");

// update_event.php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $authenticate = new Auth();
    // $authenticate->authenticate();


    $route = new updateEventController();
    $route->updateEventbyId();
}
