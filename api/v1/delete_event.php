<?php

require_once "../Middleware/GlobalAuth.php";

$authenticate = new Auth();
$authenticate->authenticate();

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../Controllers/delete_event.controller.php";
require_once "../Models/DeleteEvent.php";




$route = new deleteEvents();
$route->deleteEvents();

