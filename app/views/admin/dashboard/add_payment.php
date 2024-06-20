<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Realizar Pago'; ?></h1>

<form action="<?php echo APP_URL; ?>/payments/store" method="POST">
    <?php if ($data['from_reservations'] && $data['reservation']): ?>
        <input type="hidden" name="idReserva" value="<?php echo $data['reservation']->idReserva; ?>">
        <p>Reserva ID: <?php echo $data['reservation']->idReserva; ?></p>
        <p>Cliente: <?php echo $data['reservation']->cliente_nombre; ?></p>
        <p>Fecha de Reserva: <?php echo $data['reservation']->fechaEntrada; ?></p>
    <?php else: ?>
        <label for="idReserva">Reserva:</label>
        <select name="idReserva" id="idReserva" required>
            <?php foreach ($data['reservations'] as $reservation): ?>
                <option value="<?php echo $reservation->idReserva; ?>">
                    <?php echo 'ID: ' . $reservation->idReserva . ' - Cliente: ' . $reservation->cliente_nombre . ' - Fecha: ' . $reservation->fechaEntrada; ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>
    <br>

    <label for="monto">Monto:</label>
    <input type="number" name="monto" id="monto" step="0.01" required>
    <br>

    <label for="observacion">Observación:</label>
    <textarea name="observacion" id="observacion"></textarea>
    <br>

    <label for="idMetodoPago">Método de Pago:</label>
    <select name="idMetodoPago" id="idMetodoPago" required>
        <?php foreach ($data['methods'] as $method): ?>
            <option value="<?php echo $method->idMetodoPago; ?>"><?php echo $method->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="estado_pago">Estado de Pago:</label>
    <select name="estado_pago" id="estado_pago" required>
        <option value="pendiente">Pendiente</option>
        <option value="completado">Completado</option>
        <option value="parcial">Parcial</option>
    </select>
    <br>

    <button type="submit">Realizar Pago</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
