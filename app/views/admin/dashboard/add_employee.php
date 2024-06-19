<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Empleado'; ?></h1>

<form action="<?php echo APP_URL; ?>/employees/store" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <br>
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" required>
    <br>
    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <br>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" required>
    <br>
    <label for="salario">Salario:</label>
    <input type="text" name="salario" id="salario" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" required>
    <br>
    <label for="role">Rol:</label>
    <select name="role" id="role" required>
        <?php foreach ($data['roles'] as $role): ?>
            <option value="<?php echo $role->idRol; ?>"><?php echo $role->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Agregar Empleado</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
