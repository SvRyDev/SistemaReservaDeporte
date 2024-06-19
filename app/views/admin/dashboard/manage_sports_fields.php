<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Campos Deportivos'; ?></h1>

<a href="<?php echo APP_URL; ?>/sportsFields/create">Agregar Nuevo Campo Deportivo</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Alquiler por Hora</th>
            <th>Tipo de Deporte</th>
            <th>Estado</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['fields'] as $field): ?>
        <tr>
            <td><?php echo $field->idCampo; ?></td>
            <td><?php echo $field->codigo; ?></td>
            <td><?php echo $field->alquilerHora; ?></td>
            <td><?php echo $field->tipo_deporte; ?></td>
            <td><?php echo $field->estado; ?></td>
            <td><?php echo $field->disponible ? 'Sí' : 'No'; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/sportsFields/edit/<?php echo $field->idCampo; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/sportsFields/delete/<?php echo $field->idCampo; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
