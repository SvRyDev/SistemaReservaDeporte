<?php require_once __DIR__ . '/templates/header.php'; ?>


<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 ">
                            <h5></h5>
                            <a href="<?php echo APP_URL; ?>/sportsFields/create" class="btn btn-success text-white">
                                <i class="fas fa-plus-circle"></i> Nuevo <?= $data['singular']; ?>
                            </a>
                        </div>
                    </div>

                    <br>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Monto</th>
                                    <th>Fecha de Pago</th>
                                    <th>Observación</th>
                                    <th>ID Reserva</th>
                                    <th>Método de Pago</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['payments'] as $payment) : ?>
                                    <tr>
                                        <td><?php echo $payment->idPago; ?></td>
                                        <td><?php echo $payment->monto; ?></td>
                                        <td><?php echo $payment->fechaPago; ?></td>
                                        <td><?php echo $payment->observacion; ?></td>
                                        <td><?php echo $payment->idReserva; ?></td>
                                        <td><?php echo $payment->metodo_nombre; ?></td>
                                        <td>
                                            <a class="btn btn-warning text-white edit-employee-btn btn-sm" href="<?php echo APP_URL; ?>/payments/edit/<?php echo $payment->idPago; ?>">
                                                <i class="far fa-edit"></i> Editar

                                            </a>
                                            <a class="btn btn-danger text-white delete-employee-btn btn-sm" href="<?php echo APP_URL; ?>/payments/delete/<?php echo $payment->idPago; ?>">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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