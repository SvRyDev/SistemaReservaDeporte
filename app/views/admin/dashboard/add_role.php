<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Rol'; ?></h1>

<form action="<?php echo APP_URL; ?>/roles/store" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required></textarea>
    <br>
    <button type="submit">Agregar Rol</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
