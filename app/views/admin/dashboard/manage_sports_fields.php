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
                                    <th>Código</th>
                                    <th>Alquiler por Hora</th>
                                    <th>Tipo de Deporte</th>
                                    <th>Estado</th>
                                    <th>Disponible</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['fields'] as $field) : ?>
                                    <tr>
                                        <td><?php echo $field->idCampo; ?></td>
                                        <td><?php echo $field->codigo; ?></td>
                                        <td><?php echo $field->alquilerHora; ?></td>
                                        <td><?php echo $field->tipo_deporte; ?></td>
                                        <td><?php echo $field->estado; ?></td>
                                        <td><?php echo $field->disponible ? 'Sí' : 'No'; ?></td>
                                        <td>
                                            <a class="btn btn-warning text-white edit-employee-btn btn-sm" href="<?php echo APP_URL; ?>/sportsFields/edit/<?php echo $field->idCampo; ?>">
                                                <i class="far fa-edit"></i> Editar

                                            </a>
                                            <a class="btn btn-danger text-white delete-employee-btn btn-sm" href="<?php echo APP_URL; ?>/sportsFields/delete/<?php echo $field->idCampo; ?>">
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