<?php require_once __DIR__ . '/templates/header.php'; ?>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <form action="<?php echo APP_URL; ?>/payments/update" method="POST">
                        <input type="hidden" name="idPago" value="<?php echo $data['payment']->idPago; ?>">

                        <?php if ($data['from_reservations'] && $data['reservation']) : ?>
                            <input type="hidden" name="idReserva" value="<?php echo $data['reservation']->idReserva; ?>">
                            <p>Reserva ID: <?php echo $data['reservation']->idReserva; ?></p>
                            <p>Cliente: <?php echo $data['reservation']->cliente_nombre; ?></p>
                            <p>Fecha de Reserva: <?php echo $data['reservation']->fechaEntrada; ?></p>
                        <?php else : ?>
                            <label for="idReserva">Reserva:</label>
                            <select name="idReserva" id="idReserva" required>
                                <?php foreach ($data['reservations'] as $reservation) : ?>
                                    <option value="<?php echo $reservation->idReserva; ?>" <?php echo $data['payment']->idReserva == $reservation->idReserva ? 'selected' : ''; ?>>
                                        <?php echo 'ID: ' . $reservation->idReserva . ' - Cliente: ' . $reservation->cliente_nombre . ' - Fecha: ' . $reservation->fechaEntrada; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                        <br>

                        <label for="monto">Monto:</label>
                        <input class="form-control" type="number" name="monto" id="monto" step="0.01" value="<?php echo $data['payment']->monto; ?>" required>
                        <br>

                        <label for="fechaPago">Fecha de Pago:</label>
                        <input class="form-control" type="datetime-local" name="fechaPago" id="fechaPago" value="<?php echo $data['payment']->fechaPago; ?>" required>
                        <br>

                        <label for="observacion">Observación:</label>
                        <textarea class="form-control" name="observacion" id="observacion"><?php echo $data['payment']->observacion; ?></textarea>
                        <br>

                        <label for="idMetodoPago">Método de Pago:</label>
                        <select class="form-control" name="idMetodoPago" id="idMetodoPago" required>
                            <?php foreach ($data['methods'] as $method) : ?>
                                <option value="<?php echo $method->idMetodoPago; ?>" <?php echo $data['payment']->idMetodoPago == $method->idMetodoPago ? 'selected' : ''; ?>>
                                    <?php echo $method->nombre; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <br>

                        <label for="estado_pago">Estado de Cancelación:</label>
                        <select class="form-control" name="estado_pago" id="estado_pago" required>
                            <option value="pendiente" <?php echo $data['reservation']->estado_pago == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="completado" <?php echo $data['reservation']->estado_pago == 'completado' ? 'selected' : ''; ?>>Completado</option>
                            <option value="parcial" <?php echo $data['reservation']->estado_pago == 'parcial' ? 'selected' : ''; ?>>Parcial</option>
                        </select>
                        <br>
                        
                        <button class="btn btn-info" type="submit">Actualizar Pago</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>