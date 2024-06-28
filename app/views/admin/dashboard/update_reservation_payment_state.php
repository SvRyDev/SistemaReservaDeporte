<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Actualizar Estado de Pago de Reserva'; ?></h1>

<form action="<?php echo APP_URL; ?>/reservations/updatePaymentState/<?php echo $data['reservation']->idReserva; ?>" method="POST">
    <label for="estado_pago">Estado de Pago:</label>
    <select name="estado_pago" id="estado_pago" required>
        <option value="pendiente" <?php echo $data['reservation']->estado_pago == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
        <option value="completado" <?php echo $data['reservation']->estado_pago == 'completado' ? 'selected' : ''; ?>>Completado</option>
        <option value="parcial" <?php echo $data['reservation']->estado_pago == 'parcial' ? 'selected' : ''; ?>>Parcial</option>
    </select>
    <br>
    <button type="submit">Actualizar Estado de Pago</button>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
