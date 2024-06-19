<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Implemento Deportivo'; ?></h1>

<form action="<?php echo APP_URL; ?>/sportEquipments/store" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required></textarea>
    <br>
    <label for="precioAlquiler">Precio de Alquiler:</label>
    <input type="text" name="precioAlquiler" id="precioAlquiler" required>
    <br>
    <label for="estado">Estado:</label>
    <input type="text" name="estado" id="estado" required>
    <br>
    <button type="submit">Agregar Implemento Deportivo</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
