<?php
require_once "../../vendor/autoload.php";

Zeero\Kernel::ApplicationBoot();

require_once "../routes.php";
require_once "../router.php";
require_once "../Views/functions.php";

$router->run($app->getAllRoutes() ?? []);