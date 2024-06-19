<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Roles'; ?></h1>

<a href="<?php echo APP_URL; ?>/roles/create">Agregar Nuevo Rol</a>

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
        <?php foreach ($data['roles'] as $role): ?>
        <tr>
            <td><?php echo $role->idRol; ?></td>
            <td><?php echo $role->nombre; ?></td>
            <td><?php echo $role->descripcion; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/roles/edit/<?php echo $role->idRol; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/roles/delete/<?php echo $role->idRol; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
