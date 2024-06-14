<?php require_once 'templates/header.php'; ?>
<h1><?php echo isset($data['title']) ? $data['title'] : 'Página de Inicio'; ?></h1>
<?php if (isset($_SESSION['user_name'])): ?>
    <p>Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?>. ¡Bienvenido de nuevo!</p>
<?php else: ?>
    <p>Bienvenido a nuestro sistema de reserva de deportes.</p>
<?php endif; ?>
<?php require_once 'templates/footer.php'; ?>
