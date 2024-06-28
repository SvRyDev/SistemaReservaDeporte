<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Agregar Campo Deportivo'; ?></h1>

<form action="<?php echo APP_URL; ?>/sportsFields/store" method="POST">
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo" required>
    <br>
    <label for="alquilerHora">Alquiler por Hora:</label>
    <input type="text" name="alquilerHora" id="alquilerHora" required>
    <br>
    <label for="idTipoDeporte">Tipo de Deporte:</label>
    <select name="idTipoDeporte" id="idTipoDeporte" required>
        <?php foreach ($data['sports'] as $sport): ?>
            <option value="<?php echo $sport->idTipoDeporte; ?>"><?php echo $sport->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="estado">Estado:</label>
    <input type="text" name="estado" id="estado" required>
    <br>
    <label for="disponible">Disponible:</label>
    <input type="checkbox" name="disponible" id="disponible">
    <br>
    <button type="submit">Agregar Campo Deportivo</button>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
