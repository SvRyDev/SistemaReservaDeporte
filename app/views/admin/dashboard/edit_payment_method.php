<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Método de Pago'; ?></h1>

<form action="<?php echo APP_URL; ?>/paymentMethods/update" method="POST">
    <input type="hidden" name="idMetodoPago" value="<?php echo $data['paymentMethod']->idMetodoPago; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['paymentMethod']->nombre; ?>" required>
    <br>
    <label for="notas">Notas:</label>
    <textarea name="notas" id="notas"><?php echo $data['paymentMethod']->notas; ?></textarea>
    <br>
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo" value="<?php echo $data['paymentMethod']->codigo; ?>" required>
    <br>
    <label for="tarifa_adicional">Tarifa Adicional:</label>
    <input type="number" step="0.01" name="tarifa_adicional" id="tarifa_adicional" value="<?php echo $data['paymentMethod']->tarifa_adicional; ?>">
    <br>
    <label for="disponible">Disponible:</label>
    <input type="checkbox" name="disponible" id="disponible" <?php echo $data['paymentMethod']->disponible ? 'checked' : ''; ?>>
    <br>
    <label for="url_integracion">URL de Integración:</label>
    <input type="text" name="url_integracion" id="url_integracion" value="<?php echo $data['paymentMethod']->url_integracion; ?>">
    <br>
    <button type="submit">Actualizar Método de Pago</button>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
