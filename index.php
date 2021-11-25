<?php

declare(strict_types=1);

spl_autoload_register(function ($classname) {
    $classname = str_replace(['\\', 'App/'], ['/', ''], $classname);
    $path = 'src/' . $classname . '.php';

    require_once($path);
});


use App\Controller\AbstractController;
use App\Request;
use App\Controller\User\UserController;

$configuration = require_once('config/Configuration.php');
require_once("src/Utils/debug.php");
$request = new Request($_GET, $_POST, $_SERVER, $_FILES);
AbstractController::init_configuration($configuration);
//$controller = new Controller($request);
$controllerUser = new UserController($request);
//$controller->run();
$controllerUser->run();
