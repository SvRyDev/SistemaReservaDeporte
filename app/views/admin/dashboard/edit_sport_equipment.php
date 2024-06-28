<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Implemento Deportivo'; ?></h1>

<form action="<?php echo APP_URL; ?>/sportEquipments/update" method="POST">
    <input type="hidden" name="idImplemento" value="<?php echo $data['equipment']->idImplemento; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['equipment']->nombre; ?>" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required><?php echo $data['equipment']->descripcion; ?></textarea>
    <br>
    <label for="precioAlquiler">Precio de Alquiler:</label>
    <input type="text" name="precioAlquiler" id="precioAlquiler" value="<?php echo $data['equipment']->precioAlquiler; ?>" required>
    <br>
    <label for="estado">Estado:</label>
    <input type="text" name="estado" id="estado" value="<?php echo $data['equipment']->estado; ?>" required>
    <br>
    <button type="submit">Actualizar Implemento Deportivo</button>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
