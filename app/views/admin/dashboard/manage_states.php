<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Estados'; ?></h1>

<a href="<?php echo APP_URL; ?>/state/create">Agregar Nuevo Estado</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Considerar Solapamiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['states'] as $state): ?>
        <tr>
            <td><?php echo $state->idEstado; ?></td>
            <td><?php echo $state->nombre; ?></td>
            <td><?php echo $state->descripcion; ?></td>
            <td><?php echo $state->considerar_solapamiento ? 'Sí' : 'No'; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/state/edit/<?php echo $state->idEstado; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/state/delete/<?php echo $state->idEstado; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
