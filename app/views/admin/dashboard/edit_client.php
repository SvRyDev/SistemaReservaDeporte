<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Cliente'; ?></h1>

<form action="<?php echo APP_URL; ?>/clients/update" method="POST">
    <input type="hidden" name="idCliente" value="<?php echo $data['client']->idCliente; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['client']->nombre; ?>" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo $data['client']->telefono; ?>" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $data['client']->email; ?>" required>
    <br>
    <button type="submit">Actualizar</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
