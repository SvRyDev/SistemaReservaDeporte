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
                            <a href="<?php echo APP_URL; ?>/sports/create" class="btn btn-success text-white">
                                <i class="fas fa-plus-circle"></i> Nuevo <?php echo $data['singular']?>
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
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['sports'] as $sport) : ?>
                                    <tr>
                                        <td><?php echo $sport->idTipoDeporte; ?></td>
                                        <td><?php echo $sport->nombre; ?></td>
                                        <td><?php echo $sport->descripcion; ?></td>
                                        <td>
                                            <a class="btn btn-warning text-white edit-employee-btn btn-sm" href="<?php echo APP_URL; ?>/sports/edit/<?php echo $sport->idTipoDeporte; ?>">
                                                <i class="far fa-edit"></i> Editar
                                            </a>
                                            <a class="btn btn-danger text-white delete-employee-btn btn-sm" href="<?php echo APP_URL; ?>/sports/delete/<?php echo $sport->idTipoDeporte; ?>">
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