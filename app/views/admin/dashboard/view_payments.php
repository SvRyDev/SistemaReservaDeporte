<?php require_once __DIR__ . '/templates/header.php'; ?>

<div class="container-fluid view-print">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">



                    <p>Reserva ID: <?php echo $data['reservation']->idReserva; ?></p>
                    <p>Cliente: <?php echo $data['reservation']->cliente_nombre; ?></p>
                    <p>Fecha de Reserva: <?php echo $data['reservation']->fechaEntrada; ?></p>
                    <button class="btn btn-primary mb-2 boton-imprimir" href="" onclick="window.print()"><i class="mdi mdi-printer"></i> Imprimir</button>
                    
                    <table  class="table table-striped">
                        <thead class="table-dark ">
                            <tr>
                                <th class="text-white" scope="col">ID Pago </th>
                                <th class="text-white" scope="col">Monto</th>
                                <th class="text-white" scope="col">Fecha de Pago</th>
                                <th class="text-white" scope="col">Observación</th>
                                <th class="text-white" scope="col">Método de Pago</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['payments'] as $payment) : ?>
                                <tr>
                                    <td><?php echo $payment->idPago; ?></td>
                                    <td><?php echo $payment->monto; ?></td>
                                    <td><?php echo $payment->fechaPago; ?></td>
                                    <td><?php echo $payment->observacion; ?></td>
                                    <td><?php echo $payment->metodo_nombre; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/templates/footer.php'; ?>