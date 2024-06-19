<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Empleados'; ?></h1>

<a href="<?php echo APP_URL; ?>/employees/create">Agregar Nuevo Empleado</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Salario</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['employees'] as $employee): ?>
        <tr>
            <td><?php echo $employee->idEmpleado; ?></td>
            <td><?php echo $employee->nombre; ?></td>
            <td><?php echo $employee->apellido; ?></td>
            <td><?php echo $employee->dni; ?></td>
            <td><?php echo $employee->telefono; ?></td>
            <td><?php echo $employee->email; ?></td>
            <td><?php echo $employee->direccion; ?></td>
            <td><?php echo $employee->salario; ?></td>
            <td><?php echo $employee->rol_nombre; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/employees/edit/<?php echo $employee->idEmpleado; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/employees/delete/<?php echo $employee->idEmpleado; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
