<?php require_once __DIR__ . '/templates/header.php'; ?>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">




                    <?php if (isset($data['error'])) : ?>
                        <p style="color: red;"><?php echo $data['error']; ?></p>
                    <?php endif; ?>

                    <form action="<?php echo APP_URL; ?>/reservations/update" method="POST">
                        <input type="hidden" name="idReserva" value="<?php echo $data['reservation']->idReserva; ?>">

                        <div class="row">
                            <div class="form-group col-lg-6 mb-3">
                                <label for="idCampo" class="form-label">Campo Deportivo:</label>
                                <select name="idCampo" id="idCampo" class="form-select" data-price="<?php echo $data['reservation']->precioTotal; ?>" onchange="calculateTotalPrice()" required>
                                    <?php foreach ($data['fields'] as $field) : ?>
                                        <option value="<?php echo $field->idCampo; ?>" data-price="<?php echo $field->alquilerHora; ?>" <?php echo $data['reservation']->idCampo == $field->idCampo ? 'selected' : ''; ?>><?php echo $field->codigo; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="idCliente" class="form-label">Cliente:</label>
                                <select name="idCliente" id="idCliente" class="form-select" required>
                                    <?php foreach ($data['clients'] as $client) : ?>
                                        <option value="<?php echo $client->idCliente; ?>" <?php echo $data['reservation']->idCliente == $client->idCliente ? 'selected' : ''; ?>><?php echo $client->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="detalle" class="form-label">Detalle:</label>
                                <textarea name="detalle" id="detalle" class="form-control" required><?php echo $data['reservation']->detalle; ?></textarea>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="fechaEntrada" class="form-label">Fecha Entrada:</label>
                                <input type="datetime-local" name="fechaEntrada" id="fechaEntrada" class="form-control" value="<?php echo $data['reservation']->fechaEntrada; ?>" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="fechaSalida" class="form-label">Fecha Salida:</label>
                                <input type="datetime-local" name="fechaSalida" id="fechaSalida" class="form-control" value="<?php echo $data['reservation']->fechaSalida; ?>" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="duracion" class="form-label">Duración (horas):</label>
                                <input type="number" name="duracion" id="duracion" class="form-control" value="<?php echo $data['reservation']->duracion; ?>" required onchange="calculateTotalPrice()">
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="precioTotal" class="form-label">Precio Total:</label>
                                <input type="text" name="precioTotal" id="precioTotal" class="form-control" value="<?php echo $data['reservation']->precioTotal; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="implementos" class="form-label">Implementos Deportivos:</label>
                                <?php
                                function isChecked($idImplemento, $selectedImplementos)
                                {
                                    foreach ($selectedImplementos as $implemento) {
                                        if ($implemento->idImplemento == $idImplemento) {
                                            return true;
                                        }
                                    }
                                    return false;
                                }

                                function getImplementoValue($implementos, $id, $key)
                                {
                                    foreach ($implementos as $implemento) {
                                        if ($implemento->idImplemento == $id) {
                                            return $implemento->$key;
                                        }
                                    }
                                    return '';
                                }

                                foreach ($data['equipments'] as $equipment) : ?>
                                    <div class="form-check">
                                        <input type="checkbox" name="implementos[<?php echo $equipment->idImplemento; ?>][id]" value="<?php echo $equipment->idImplemento; ?>" class="form-check-input" <?php echo isset($data['reservation']->implementos) && isChecked($equipment->idImplemento, $data['reservation']->implementos) ? 'checked' : ''; ?>>
                                        <label class="form-check-label"><?php echo $equipment->nombre; ?></label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" name="implementos[<?php echo $equipment->idImplemento; ?>][cantidad]" class="form-control" placeholder="Cantidad" value="<?php echo isset($data['reservation']->implementos) ? getImplementoValue($data['reservation']->implementos, $equipment->idImplemento, 'Cantidad') : ''; ?>">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="implementos[<?php echo $equipment->idImplemento; ?>][precio]" class="form-control" placeholder="Precio Total" value="<?php echo isset($data['reservation']->implementos) ? getImplementoValue($data['reservation']->implementos, $equipment->idImplemento, 'PrecioTotal') : ''; ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-info text-white"><i class="mdi mdi-update"></i>
                         Actualizar Reserva</button>
                    </form>

                </div>
                <script>
                    function calculateTotalPrice() {
                        let campo = document.getElementById('idCampo');
                        let duracion = document.getElementById('duracion').value;
                        let precioCampo = campo.options[campo.selectedIndex].getAttribute('data-price');

                        let precioTotal = precioCampo * duracion;

                        document.getElementById('precioTotal').value = precioTotal.toFixed(2);
                    }
                </script>




            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>




<?php require_once __DIR__ . '/templates/footer.php'; ?>