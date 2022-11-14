<?php
require_once './libs/router.php';
require_once './app/controllers/students-api.controller.php';

$router = new Router();

// Tabla de ruteo
$router->addRoute('students', 'GET', 'StudentsApiController', 'getAll');
$router->addRoute('students/:ID', 'GET', 'StudentsApiController', 'get');
$router->addRoute('students/:ID', 'DELETE', 'StudentsApiController', 'removeStudent');
$router->addRoute('students', 'POST', 'StudentsApiController', 'insertStudent'); 
$router->addRoute('students/:ID', 'PUT', 'StudentsApiController', 'editStudent'); 

//Ruta
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);