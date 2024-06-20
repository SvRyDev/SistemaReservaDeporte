<?php
// Definir la zona horaria a Lima, Perú
date_default_timezone_set('America/Lima');

// Database configuration (adjust with your actual database credentials)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db-reserva-deporte');

// Application URL
define('APP_URL', 'http://localhost/sistema-reserva-deporte');

// Default Controller
define('DEFAULT_CONTROLLER', 'HomeController');

// Nombre Empresa
define('NOMBRE_EMPRESA','Montalván');

define('STYLE_URL', 'http://localhost/sistema-reserva-deporte/public/css');

// Encriptation pattron
define('ENCRYPT', 'sha256');

// Definir una constante para la hora actual
define('CURRENT_TIME', date('Y-m-d H:i:s'));

?>
