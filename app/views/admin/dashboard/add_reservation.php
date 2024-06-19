<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Reserva'; ?></h1>

<form action="<?php echo APP_URL; ?>/reservations/store" method="POST">
    <label for="idCampo">Campo:</label>
    <select name="idCampo" id="idCampo" required onchange="calculateTotalPrice()">
        <option value="" data-price="0">Seleccione un campo</option>
        <?php foreach ($data['fields'] as $field): ?>
            <option value="<?php echo $field->idCampo; ?>" data-price="<?php echo $field->alquilerHora; ?>"><?php echo $field->codigo; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="idCliente">Cliente:</label>
    <select name="idCliente" id="idCliente" required>
        <?php foreach ($data['clients'] as $client): ?>
            <option value="<?php echo $client->idCliente; ?>"><?php echo $client->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="detalle">Detalle:</label>
    <textarea name="detalle" id="detalle" required></textarea>
    <br>
    <label for="fechaEntrada">Fecha Entrada:</label>
    <input type="datetime-local" name="fechaEntrada" id="fechaEntrada" required>
    <br>
    <label for="fechaSalida">Fecha Salida:</label>
    <input type="datetime-local" name="fechaSalida" id="fechaSalida" required>
    <br>
    <label for="duracion">Duración (horas):</label>
    <input type="number" name="duracion" id="duracion" required onchange="calculateTotalPrice()">
    <br>
    <label for="precioTotal">Precio Total:</label>
    <input type="text" name="precioTotal" id="precioTotal" required>
    <br>
    <label for="idEstado">Estado:</label>
    <select name="idEstado" id="idEstado" required>
        <?php foreach ($data['states'] as $state): ?>
            <option value="<?php echo $state->idEstado; ?>"><?php echo $state->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Agregar Reserva</button>
</form>

<script>
    function calculateTotalPrice() {
        const fieldSelect = document.getElementById('idCampo');
        const durationInput = document.getElementById('duracion');
        const totalPriceInput = document.getElementById('precioTotal');

        const selectedField = fieldSelect.options[fieldSelect.selectedIndex];
        const pricePerHour = parseFloat(selectedField.getAttribute('data-price'));
        const duration = parseFloat(durationInput.value);

        if (!isNaN(pricePerHour) && !isNaN(duration)) {
            const totalPrice = pricePerHour * duration;
            totalPriceInput.value = totalPrice.toFixed(2);
            totalPriceInput.placeholder = totalPrice.toFixed(2);
        }
    }
</script>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
