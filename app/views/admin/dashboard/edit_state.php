<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Estado'; ?></h1>

<form action="<?php echo APP_URL; ?>/state/update" method="POST">
    <input type="hidden" name="idEstado" value="<?php echo $data['state']->idEstado; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['state']->nombre; ?>" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required><?php echo $data['state']->descripcion; ?></textarea>
    <br>
    <label for="considerar_solapamiento">Considerar Solapamiento:</label>
    <input type="checkbox" name="considerar_solapamiento" id="considerar_solapamiento" <?php echo $data['state']->considerar_solapamiento ? 'checked' : ''; ?>>
    <br>
    <button type="submit">Actualizar Estado</button>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
