<?php
// require_once __DIR__ . '/../app/routes/PostRoute.php';

require_once "../Middleware/GlobalAuth.php";

$authenticate = new Auth();
$authenticate->authenticate();

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../Models/Staff.php";
require_once "../Middleware/StaffWare.php";

$route = new AddStaffWare();
$route->store();

