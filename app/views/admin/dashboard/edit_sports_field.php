<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Campo Deportivo'; ?></h1>

<form action="<?php echo APP_URL; ?>/sportsFields/update" method="POST">
    <input type="hidden" name="idCampo" value="<?php echo $data['field']->idCampo; ?>">
    <label for="codigo">Código:</label>
    <input type="text" name="codigo" id="codigo" value="<?php echo $data['field']->codigo; ?>" required>
    <br>
    <label for="alquilerHora">Alquiler por Hora:</label>
    <input type="text" name="alquilerHora" id="alquilerHora" value="<?php echo $data['field']->alquilerHora; ?>" required>
    <br>
    <label for="idTipoDeporte">Tipo de Deporte:</label>
    <select name="idTipoDeporte" id="idTipoDeporte" required>
        <?php foreach ($data['sports'] as $sport): ?>
            <option value="<?php echo $sport->idTipoDeporte; ?>" <?php echo $data['field']->idTipoDeporte == $sport->idTipoDeporte ? 'selected' : ''; ?>><?php echo $sport->nombre; ?></option>
        <?php endforeach; ?>
    </select>
    <br>
    <label for="estado">Estado:</label>
    <input type="text" name="estado" id="estado" value="<?php echo $data['field']->estado; ?>" required>
    <br>
    <label for="disponible">Disponible:</label>
    <input type="checkbox" name="disponible" id="disponible" <?php echo $data['field']->disponible ? 'checked' : ''; ?>>
    <br>
    <button type="submit">Actualizar Campo Deportivo</button>
</form>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
