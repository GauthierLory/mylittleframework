<?php
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Framework\Dispatcher;

$_ENV['PROJECT_DIR'] = __DIR__;
$dotenv = new Dotenv(__DIR__);
$dotenv->load(__DIR__.'/.env');

$dispatcher = new Dispatcher(Request::createFromGlobals());
