<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Estado'; ?></h1>

<form action="<?php echo APP_URL; ?>/state/store" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required></textarea>
    <br>
    <label for="considerar_solapamiento">Considerar Solapamiento:</label>
    <input type="checkbox" name="considerar_solapamiento" id="considerar_solapamiento">
    <br>
    <button type="submit">Agregar Estado</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
