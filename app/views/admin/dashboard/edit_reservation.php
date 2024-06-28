<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Reserva'; ?></h1>

<?php if (isset($data['error'])): ?>
    <p style="color: red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<form action="<?php echo APP_URL; ?>/reservations/update" method="POST">
    <input type="hidden" name="idReserva" value="<?php echo $data['reservation']->idReserva; ?>">
    <label for="idCampo">Campo Deportivo:</label>
    <select name="idCampo" id="idCampo" data-price="<?php echo $data['reservation']->precioTotal; ?>" onchange="calculateTotalPrice()" required>
        <?php foreach ($data['fields'] as $field): ?>
            <option value="<?php echo $field->idCampo; ?>" data-price="<?php echo $field->alquilerHora; ?>" <?php echo $data['reservation']->idCampo == $field->idCampo ? 'selected' : ''; ?>><?php echo $field->codigo; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="idCliente">Cliente:</label>
    <select name="idCliente" id="idCliente" required>
        <?php foreach ($data['clients'] as $client): ?>
            <option value="<?php echo $client->idCliente; ?>" <?php echo $data['reservation']->idCliente == $client->idCliente ? 'selected' : ''; ?>><?php echo $client->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="detalle">Detalle:</label>
    <textarea name="detalle" id="detalle" required><?php echo $data['reservation']->detalle; ?></textarea>
    <br>
    <label for="fechaEntrada">Fecha Entrada:</label>
    <input type="datetime-local" name="fechaEntrada" id="fechaEntrada" value="<?php echo $data['reservation']->fechaEntrada; ?>" required>
    <br>
    <label for="fechaSalida">Fecha Salida:</label>
    <input type="datetime-local" name="fechaSalida" id="fechaSalida" value="<?php echo $data['reservation']->fechaSalida; ?>" required>
    <br>
    <label for="duracion">Duración (horas):</label>
    <input type="number" name="duracion" id="duracion" value="<?php echo $data['reservation']->duracion; ?>" required onchange="calculateTotalPrice()">
    <br>
    <label for="precioTotal">Precio Total:</label>
    <input type="text" name="precioTotal" id="precioTotal" value="<?php echo $data['reservation']->precioTotal; ?>" required>
    <br>

    <label for="implementos">Implementos Deportivos:</label>
    <?php 
    function isChecked($idImplemento, $selectedImplementos) {
        foreach ($selectedImplementos as $implemento) {
            if ($implemento->idImplemento == $idImplemento) {
                return true;
            }
        }
        return false;
    }
    
    function getImplementoValue($implementos, $id, $key) {
        foreach ($implementos as $implemento) {
            if ($implemento->idImplemento == $id) {
                return $implemento->$key;
            }
        }
        return '';
    }
    
    foreach ($data['equipments'] as $equipment): ?>
        <div>
            <input type="checkbox" name="implementos[<?php echo $equipment->idImplemento; ?>][id]" value="<?php echo $equipment->idImplemento; ?>" <?php echo isset($data['reservation']->implementos) && isChecked($equipment->idImplemento, $data['reservation']->implementos) ? 'checked' : ''; ?>>
            <label><?php echo $equipment->nombre; ?></label>
            <input type="number" name="implementos[<?php echo $equipment->idImplemento; ?>][cantidad]" placeholder="Cantidad" value="<?php echo isset($data['reservation']->implementos) ? getImplementoValue($data['reservation']->implementos, $equipment->idImplemento, 'Cantidad') : ''; ?>">
            <input type="text" name="implementos[<?php echo $equipment->idImplemento; ?>][precio]" placeholder="Precio Total" value="<?php echo isset($data['reservation']->implementos) ? getImplementoValue($data['reservation']->implementos, $equipment->idImplemento, 'PrecioTotal') : ''; ?>">
        </div>
    <?php endforeach; ?>
    <br>
    <button type="submit">Actualizar Reserva</button>
</form>

<script>
function calculateTotalPrice() {
    var field = document.getElementById('idCampo');
    var pricePerHour = parseFloat(field.options[field.selectedIndex].getAttribute('data-price'));
    var duration = parseFloat(document.getElementById('duracion').value);
    var totalPrice = pricePerHour * duration;
    document.getElementById('precioTotal').value = totalPrice.toFixed(2);
}
</script>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
