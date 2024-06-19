<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Reservas'; ?></h1>

<a href="<?php echo APP_URL; ?>/reservations/create">Agregar Nueva Reserva</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Campo</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Detalle</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <th>Duración</th>
            <th>Precio Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['reservations'] as $reservation): ?>
        <tr>
            <td><?php echo $reservation->idReserva; ?></td>
            <td><?php echo $reservation->campo_codigo; ?></td>
            <td><?php echo $reservation->cliente_nombre; ?></td>
            <td><?php echo $reservation->empleado_nombre; ?></td>
            <td><?php echo $reservation->detalle; ?></td>
            <td><?php echo $reservation->fechaEntrada; ?></td>
            <td><?php echo $reservation->fechaSalida; ?></td>
            <td><?php echo $reservation->duracion; ?></td>
            <td><?php echo $reservation->precioTotal; ?></td>
            <td><?php echo $reservation->estado_nombre; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/reservations/edit/<?php echo $reservation->idReserva; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/reservations/delete/<?php echo $reservation->idReserva; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
