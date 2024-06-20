<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Reserva'; ?></h1>

<?php if (isset($data['error'])): ?>
    <p style="color: red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<form action="<?php echo APP_URL; ?>/reservations/store" method="POST">
    <label for="idCampo">Campo Deportivo:</label>
    <select name="idCampo" id="idCampo" data-price="<?php echo $data['fields'][0]->alquilerHora; ?>" onchange="calculateTotalPrice()" required>
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
    <input type="text" name="precioTotal" id="precioTotal" placeholder="Total inicial basado en el precio del campo y duración" required>
    <br>
   
    <label for="implementos">Implementos Deportivos:</label>
    <?php foreach ($data['equipments'] as $equipment): ?>
        <div>
            <input type="checkbox" name="implementos[<?php echo $equipment->idImplemento; ?>][id]" value="<?php echo $equipment->idImplemento; ?>">
            <label><?php echo $equipment->nombre; ?></label>
            <input type="number" name="implementos[<?php echo $equipment->idImplemento; ?>][cantidad]" placeholder="Cantidad">
            <input type="text" name="implementos[<?php echo $equipment->idImplemento; ?>][precio]" placeholder="Precio Total">
        </div>
    <?php endforeach; ?>
    <br>
    <button type="submit">Agregar Reserva</button>
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

<?php require_once __DIR__ . '/../templates/footer.php'; ?>

