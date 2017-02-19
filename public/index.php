<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// load application config (error reporting etc.)
require APP . 'config/config.php';

// load application class
require APP . 'core/application.php';

// start the application
$app = new application();
$app->run();
