<?php require_once __DIR__ . '/templates/header.php'; ?>
<?php require_once __DIR__ . '/modals/modal_roles.php'; ?>

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
                            <button type="button" class="btn btn-success text-white mdl-add-btn" data-bs-toggle="modal" data-bs-target="#eventModal">
                                <i class="fas fa-plus-circle"></i> Nuevo <?= $data['singular']?>
                            </button>
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
                                <?php foreach ($data['roles'] as $role) : ?>
                                    <tr>
                                        <td><?php echo $role->idRol; ?></td>
                                        <td><?php echo $role->nombre; ?></td>
                                        <td><?php echo $role->descripcion; ?></td>
                                        <td>
                                            <a class="btn btn-warning text-white edit-employee-btn btn-sm" href="<?php echo APP_URL; ?>/roles/edit/<?php echo $role->idRol; ?>">
                                                <i class="far fa-edit"></i> Editar
                                            </a>
                                            <a class="btn btn-danger text-white delete-employee-btn btn-sm" href="<?php echo APP_URL; ?>/roles/delete/<?php echo $role->idRol; ?>">
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