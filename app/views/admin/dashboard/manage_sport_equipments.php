<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Implementos Deportivos'; ?></h1>

<a href="<?php echo APP_URL; ?>/sportEquipments/create">Agregar Nuevo Implemento Deportivo</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio de Alquiler</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['equipments'] as $equipment): ?>
        <tr>
            <td><?php echo $equipment->idImplemento; ?></td>
            <td><?php echo $equipment->nombre; ?></td>
            <td><?php echo $equipment->descripcion; ?></td>
            <td><?php echo $equipment->precioAlquiler; ?></td>
            <td><?php echo $equipment->estado; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/sportEquipments/edit/<?php echo $equipment->idImplemento; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/sportEquipments/delete/<?php echo $equipment->idImplemento; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
