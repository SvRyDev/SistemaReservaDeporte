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
                            <a href="<?php echo APP_URL; ?>/PaymentMethods/create" class="btn btn-success text-white">
                                <i class="fas fa-plus-circle"></i> Nuevo <?= $data['singular'];?>
                            </a>
                        </div>


                    </div>

                    <br>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                            <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Notas</th>
            <th>Código</th>
            <th>Tarifa Adicional</th>
            <th>Disponible</th>
            <th>URL de Integración</th>
            <th>Acciones</th>
        </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($data['paymentMethods'] as $paymentMethod): ?>
        <tr>
            <td><?php echo $paymentMethod->idMetodoPago; ?></td>
            <td><?php echo $paymentMethod->nombre; ?></td>
            <td><?php echo $paymentMethod->notas; ?></td>
            <td><?php echo $paymentMethod->codigo; ?></td>
            <td><?php echo $paymentMethod->tarifa_adicional; ?></td>
            <td><?php echo $paymentMethod->disponible ? 'Sí' : 'No'; ?></td>
            <td><?php echo $paymentMethod->url_integracion; ?></td>
            <td>
                <a class="btn btn-warning text-white edit-employee-btn btn-sm" href="<?php echo APP_URL; ?>/paymentMethods/edit/<?php echo $paymentMethod->idMetodoPago; ?>">
                <i class="far fa-edit"></i> Editar

                </a>
                <a class="btn btn-danger text-white delete-employee-btn btn-sm"  href="<?php echo APP_URL; ?>/paymentMethods/delete/<?php echo $paymentMethod->idMetodoPago; ?>">
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

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Notas</th>
            <th>Código</th>
            <th>Tarifa Adicional</th>
            <th>Disponible</th>
            <th>URL de Integración</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['paymentMethods'] as $paymentMethod): ?>
        <tr>
            <td><?php echo $paymentMethod->idMetodoPago; ?></td>
            <td><?php echo $paymentMethod->nombre; ?></td>
            <td><?php echo $paymentMethod->notas; ?></td>
            <td><?php echo $paymentMethod->codigo; ?></td>
            <td><?php echo $paymentMethod->tarifa_adicional; ?></td>
            <td><?php echo $paymentMethod->disponible ? 'Sí' : 'No'; ?></td>
            <td><?php echo $paymentMethod->url_integracion; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/paymentMethods/edit/<?php echo $paymentMethod->idMetodoPago; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/paymentMethods/delete/<?php echo $paymentMethod->idMetodoPago; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
