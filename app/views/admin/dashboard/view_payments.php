<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Pagos de la Reserva'; ?></h1>

<p>Reserva ID: <?php echo $data['reservation']->idReserva; ?></p>
<p>Cliente: <?php echo $data['reservation']->cliente_nombre; ?></p>
<p>Fecha de Reserva: <?php echo $data['reservation']->fechaEntrada; ?></p>

<a href="<?php echo APP_URL; ?>/payments/add/<?php echo $data['reservation']->idReserva; ?>">Agregar Pago</a>

<table>
    <thead>
        <tr>
            <th>ID Pago</th>
            <th>Monto</th>
            <th>Fecha de Pago</th>
            <th>Observación</th>
            <th>Método de Pago</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['payments'] as $payment): ?>
        <tr>
            <td><?php echo $payment->idPago; ?></td>
            <td><?php echo $payment->monto; ?></td>
            <td><?php echo $payment->fechaPago; ?></td>
            <td><?php echo $payment->observacion; ?></td>
            <td><?php echo $payment->metodo_nombre; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
