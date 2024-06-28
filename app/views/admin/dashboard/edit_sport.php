<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Deporte'; ?></h1>

<form action="<?php echo APP_URL; ?>/sports/update" method="POST">
    <input type="hidden" name="idTipoDeporte" value="<?php echo $data['sport']->idTipoDeporte; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['sport']->nombre; ?>" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required><?php echo $data['sport']->descripcion; ?></textarea>
    <br>
    <button type="submit">Actualizar Deporte</button>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
