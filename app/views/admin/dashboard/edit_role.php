<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Rol'; ?></h1>

<form action="<?php echo APP_URL; ?>/roles/update" method="POST">
    <input type="hidden" name="idRol" value="<?php echo $data['role']->idRol; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['role']->nombre; ?>" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required><?php echo $data['role']->descripcion; ?></textarea>
    <br>
    <button type="submit">Actualizar Rol</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
