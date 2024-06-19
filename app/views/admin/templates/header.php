<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($data['title']) ? $data['title'] : 'Default Title'; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>/public/css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?php echo APP_URL; ?>/dashboard">Dashboard</a></li>
            <li><a href="<?php echo APP_URL; ?>/clients">Gestionar Clientes</a></li>
            <li><a href="<?php echo APP_URL; ?>/roles">Gestionar Roles</a></li>
            <li><a href="<?php echo APP_URL; ?>/employees">Gestionar Empleados</a></li>
            <li><a href="<?php echo APP_URL; ?>/sports">Gestionar Deportes</a></li>
            <li><a href="<?php echo APP_URL; ?>/paymentMethods">Gestionar Métodos de Pago</a></li>
            <li><a href="<?php echo APP_URL; ?>/sportEquipments">Gestionar Implementos Deportivos</a></li>
            <li><a href="<?php echo APP_URL; ?>/sportsFields">Gestionar Campos Deportivos</a></li>
            <li><a href="<?php echo APP_URL; ?>/reservations">Gestionar Reservas</a></li>
            <li><a href="<?php echo APP_URL; ?>/state">Gestionar Estados</a></li>
            <li><a href="<?php echo APP_URL; ?>/profile">Perfil</a></li>
            <li><a href="<?php echo APP_URL; ?>/login/logout">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
