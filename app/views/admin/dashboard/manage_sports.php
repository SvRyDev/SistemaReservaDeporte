<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Deportes'; ?></h1>

<a href="<?php echo APP_URL; ?>/sports/create">Agregar Nuevo Deporte</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['sports'] as $sport): ?>
        <tr>
            <td><?php echo $sport->idTipoDeporte; ?></td>
            <td><?php echo $sport->nombre; ?></td>
            <td><?php echo $sport->descripcion; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/sports/edit/<?php echo $sport->idTipoDeporte; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/sports/delete/<?php echo $sport->idTipoDeporte; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
