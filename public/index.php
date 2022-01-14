<?php

use Framework\Dispatcher;
require_once __DIR__.'/../vendor/autoload.php';

// Framework bootstrap
require_once __DIR__.'/../app.php';
/** @var Dispatcher $dispatcher */
$dispatcher->run();