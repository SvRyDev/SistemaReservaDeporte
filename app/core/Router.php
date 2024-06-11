<?php
class Router {
    public static function route() {
        $controllerName = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : DEFAULT_CONTROLLER;
        $actionName = isset($_GET['action']) ? $_GET['action'] : 'index';
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    $controller->{$actionName}();
                } else {
                    die("Action $actionName does not exist in controller $controllerName.");
                }
            } else {
                die("Controller class $controllerName does not exist.");
            }
        } else {
            die("Controller file for $controllerName does not exist.");
        }
    }
}
?>
