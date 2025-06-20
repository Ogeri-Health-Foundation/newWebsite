<?php
// require_once __DIR__ . '/../app/routes/PostRoute.php';

require_once "../Middleware/GlobalAuth.php";

$authenticate = new Auth();
$authenticate->authenticate();

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once "../Middleware/DraftWare.php";
include_once "../Controllers/draft.controller.php";
include_once "../Models/BlogDraft.php";

$route = new DraftRoute();
$route->store();

