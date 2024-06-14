<?php
class Router {
    public static function route() {
        // Parse the URL
        $url = isset($_GET['route']) ? $_GET['route'] : '';
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        // Get the controller, action and parameters
        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : DEFAULT_CONTROLLER;
        $actionName = isset($url[1]) && !empty($url[1]) ? $url[1] : 'index';
        $params = array_slice($url, 2);

        // Construct the controller path
        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $actionName)) {
                    call_user_func_array([$controller, $actionName], $params);
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
