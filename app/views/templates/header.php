<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($data['title']) ? $data['title'] : 'Default Title'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>/public/css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?php echo APP_URL; ?>/">Inicio</a></li>
            <li><a href="<?php echo APP_URL; ?>/about">Sobre Nosotros</a></li>
            <li><a href="<?php echo APP_URL; ?>/contact">Contacto</a></li>
            <?php if (isset($_SESSION['user_name'])): ?>
                <li><a href="<?php echo APP_URL; ?>/profile">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
                <li><a href="<?php echo APP_URL; ?>/login/logout">Logout</a></li>
            <?php else: ?>
                <li><a href="<?php echo APP_URL; ?>/login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
