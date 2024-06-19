<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Empleado'; ?></h1>

<form action="<?php echo APP_URL; ?>/employees/update" method="POST">
    <input type="hidden" name="idEmpleado" value="<?php echo $data['employee']->idEmpleado; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['employee']->nombre; ?>" required>
    <br>
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" value="<?php echo $data['employee']->apellido; ?>" required>
    <br>
    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni" value="<?php echo $data['employee']->dni; ?>" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo $data['employee']->telefono; ?>" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $data['employee']->email; ?>" required>
    <br>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="<?php echo $data['employee']->direccion; ?>" required>
    <br>
    <label for="salario">Salario:</label>
    <input type="text" name="salario" id="salario" value="<?php echo $data['employee']->salario; ?>" required>
    <br>
    <label for="role">Rol:</label>
    <select name="role" id="role" required>
        <?php foreach ($data['roles'] as $role): ?>
            <option value="<?php echo $role->idRol; ?>" <?php echo $data['employee']->idRol == $role->idRol ? 'selected' : ''; ?>>
                <?php echo $role->nombre; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Actualizar</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
