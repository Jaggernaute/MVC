<?php

    $uri = $_GET['uri'] ?? 'Global/index';

    $params = explode('/', $uri);
    $controller = ucfirst($params[0]);
    $action = $params[1] ?? "index";

    if(!file_exists(ROOT . "/Controllers/{$controller}Controller.php")) {
        $controller = "Global";
    }

    require_once(ROOT . "/Controllers/{$controller}Controller.php");

    $controller .= "Controller";
    $controller = new $controller();

    if(method_exists($controller, $action)){
        $controller->$action();
    } else {
        require_once(ROOT . "/Controllers/ErrorController.php");
        $controller = new ErrorController();
        $controller->notFound();
    }