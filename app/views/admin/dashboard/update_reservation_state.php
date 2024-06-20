<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Actualizar Estado de Reserva'; ?></h1>

<form action="<?php echo APP_URL; ?>/reservations/updateState/<?php echo $data['reservation']->idReserva; ?>" method="POST">
    <label for="idEstado">Estado:</label>
    <select name="idEstado" id="idEstado" required>
        <?php foreach ($data['states'] as $state): ?>
            <option value="<?php echo $state->idEstado; ?>" <?php echo $data['reservation']->idEstado == $state->idEstado ? 'selected' : ''; ?>><?php echo $state->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Actualizar Estado</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
