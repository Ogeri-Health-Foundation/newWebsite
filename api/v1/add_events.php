<?php
error_reporting(E_ALL);
require_once "../Middleware/GlobalAuth.php";

// $authenticate = new Auth();
// $authenticate->authenticate();

ini_set('display_errors', 1);
require_once "../Models/Events.php";
require_once "../Middleware/EventsWare.php";

$route = new EventRoute();
$route->store();
$route->FetchEvents();

