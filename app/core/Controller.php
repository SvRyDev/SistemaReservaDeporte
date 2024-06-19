<?php
class Controller {
    use AuthTrait;

    protected function view($view, $data = []) {
        $viewPath = str_replace('.', '/', $view);
        if (file_exists(__DIR__ . '/../views/' . $viewPath . '.php')) {
            require_once __DIR__ . '/../views/' . $viewPath . '.php';
        } else {
            die("View $viewPath does not exist.");
        }
    }

    protected function model($model) {
        if (file_exists(__DIR__ . '/../models/' . $model . '.php')) {
            require_once __DIR__ . '/../models/' . $model . '.php';
            return new $model();
        } else {
            die("Model $model does not exist.");
        }
    }
}
?>
