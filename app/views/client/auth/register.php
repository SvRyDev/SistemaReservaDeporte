<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Register'; ?></h1>

<?php if (isset($data['error'])): ?>
    <p style="color: red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<form action="<?php echo APP_URL; ?>/register/store" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <button type="submit">Register</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
