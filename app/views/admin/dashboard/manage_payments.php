<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Pagos'; ?></h1>

<a href="<?php echo APP_URL; ?>/payments/create">Agregar Nuevo Pago</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Monto</th>
            <th>Fecha de Pago</th>
            <th>Observación</th>
            <th>ID Reserva</th>
            <th>Método de Pago</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['payments'] as $payment): ?>
        <tr>
            <td><?php echo $payment->idPago; ?></td>
            <td><?php echo $payment->monto; ?></td>
            <td><?php echo $payment->fechaPago; ?></td>
            <td><?php echo $payment->observacion; ?></td>
            <td><?php echo $payment->idReserva; ?></td>
            <td><?php echo $payment->metodo_nombre; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/payments/edit/<?php echo $payment->idPago; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/payments/delete/<?php echo $payment->idPago; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
