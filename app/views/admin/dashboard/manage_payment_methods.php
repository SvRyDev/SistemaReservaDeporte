<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Métodos de Pago'; ?></h1>

<a href="<?php echo APP_URL; ?>/paymentMethods/create">Agregar Nuevo Método de Pago</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Notas</th>
            <th>Código</th>
            <th>Tarifa Adicional</th>
            <th>Disponible</th>
            <th>URL de Integración</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['paymentMethods'] as $paymentMethod): ?>
        <tr>
            <td><?php echo $paymentMethod->idMetodoPago; ?></td>
            <td><?php echo $paymentMethod->nombre; ?></td>
            <td><?php echo $paymentMethod->notas; ?></td>
            <td><?php echo $paymentMethod->codigo; ?></td>
            <td><?php echo $paymentMethod->tarifa_adicional; ?></td>
            <td><?php echo $paymentMethod->disponible ? 'Sí' : 'No'; ?></td>
            <td><?php echo $paymentMethod->url_integracion; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/paymentMethods/edit/<?php echo $paymentMethod->idMetodoPago; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/paymentMethods/delete/<?php echo $paymentMethod->idMetodoPago; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
