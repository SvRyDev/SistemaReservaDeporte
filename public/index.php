<?php
session_start();

require_once '../config/config.php';
require_once '../app/helpers/helpers.php';
require_once '../app/core/Autoload.php';

// Assuming Router.php is in /app/core
require_once '../app/core/Router.php';

// Run the router
Router::route();
?>
