<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Clientes'; ?></h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['clients'] as $client): ?>
        <tr>
            <td><?php echo $client->idCliente; ?></td>
            <td><?php echo $client->nombre; ?></td>
            <td><?php echo $client->telefono; ?></td>
            <td><?php echo $client->email; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/clients/edit/<?php echo $client->idCliente; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/clients/delete/<?php echo $client->idCliente; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
