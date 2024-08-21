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

                    <form action="<?php echo APP_URL; ?>/reservations/store" method="POST">
                        <div class="row">


                            <div class="form-group col-lg-6 mb-3">
                                <label for="idCampo" class="form-label">Campo Deportivo:</label>
                                <select name="idCampo" id="idCampo" class="form-select" data-price="<?php echo $data['fields'][0]->alquilerHora; ?>" onchange="calculateTotalPrice()" required>
                                    <?php foreach ($data['fields'] as $field) : ?>
                                        <option value="<?php echo $field->idCampo; ?>" data-price="<?php echo $field->alquilerHora; ?>"><?php echo $field->codigo; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="idCliente" class="form-label">Cliente:</label>
                                <select name="idCliente" id="idCliente" class="form-select" required>
                                    <?php foreach ($data['clients'] as $client) : ?>
                                        <option value="<?php echo $client->idCliente; ?>"><?php echo $client->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-lg-12 mb-3">
                                <label for="detalle" class="form-label">Detalle:</label>
                                <textarea name="detalle" id="detalle" class="form-control" required></textarea>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="fechaEntrada" class="form-label">Fecha Entrada:</label>
                                <input type="datetime-local" name="fechaEntrada" id="fechaEntrada" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="fechaSalida" class="form-label">Fecha Salida:</label>
                                <input type="datetime-local" name="fechaSalida" id="fechaSalida" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="duracion" class="form-label">Duración (horas):</label>
                                <input type="number" name="duracion" id="duracion" class="form-control" required onchange="calculateTotalPrice()">
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="precioTotal" class="form-label">Precio Total:</label>
                                <input type="text" name="precioTotal" id="precioTotal" class="form-control" placeholder="Total inicial basado en el precio del campo y duración" required>
                            </div>

                            <div class="form-group col-lg-12 mb-3">
                                <label for="implementos" class="form-label">Implementos Deportivos:</label>
                                <?php foreach ($data['equipments'] as $equipment) : ?>
                                    <div class="form-check">
                                        <input type="checkbox" name="implementos[<?php echo $equipment->idImplemento; ?>][id]" value="<?php echo $equipment->idImplemento; ?>" class="form-check-input">
                                        <label class="form-check-label"><?php echo $equipment->nombre; ?></label>
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" name="implementos[<?php echo $equipment->idImplemento; ?>][cantidad]" class="form-control" placeholder="Cantidad">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="implementos[<?php echo $equipment->idImplemento; ?>][precio]" class="form-control" placeholder="Precio Total">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success text-white">Agregar Reserva</button>
                    </form>

                    <script>
                        function calculateTotalPrice() {
                            var field = document.getElementById('idCampo');
                            var pricePerHour = parseFloat(field.options[field.selectedIndex].getAttribute('data-price'));
                            var duration = parseFloat(document.getElementById('duracion').value);
                            var totalPrice = pricePerHour * duration;
                            document.getElementById('precioTotal').value = totalPrice.toFixed(2);
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
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>