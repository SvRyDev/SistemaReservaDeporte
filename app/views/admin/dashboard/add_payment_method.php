<?php require_once __DIR__ . '/templates/header.php'; ?>


<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Método de Pago'; ?></h1>

<form action="<?php echo APP_URL; ?>/paymentMethods/store" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br>
    <label for="notas">Notas:</label>
    <textarea name="notas" id="notas"></textarea>
    <br>
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo" required>
    <br>
    <label for="tarifa_adicional">Tarifa Adicional:</label>
    <input type="number" step="0.01" name="tarifa_adicional" id="tarifa_adicional">
    <br>
    <label for="disponible">Disponible:</label>
    <input type="checkbox" name="disponible" id="disponible">
    <br>
    <label for="url_integracion">URL de Integración:</label>
    <input type="text" name="url_integracion" id="url_integracion">
    <br>
    <button type="submit">Agregar Método de Pago</button>
</form>

<?php require_once __DIR__ . 'templates/footer.php'; ?>>
