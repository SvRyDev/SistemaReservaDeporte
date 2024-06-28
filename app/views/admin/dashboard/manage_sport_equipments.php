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
                            <a href="<?php echo APP_URL; ?>/sportEquipments/create" class="btn btn-success text-white">
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
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio de Alquiler</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['equipments'] as $equipment) : ?>
                                    <tr>
                                        <td><?php echo $equipment->idImplemento; ?></td>
                                        <td><?php echo $equipment->nombre; ?></td>
                                        <td><?php echo $equipment->descripcion; ?></td>
                                        <td><?php echo $equipment->precioAlquiler; ?></td>
                                        <td><?php echo $equipment->estado; ?></td>
                                        <td>
                                            <a class="btn btn-warning text-white edit-employee-btn btn-sm" href="<?php echo APP_URL; ?>/sportEquipments/edit/<?php echo $equipment->idImplemento; ?>">
                                                <i class="far fa-edit"></i> Editar
                                            </a>
                                            <a class="btn btn-danger text-white delete-employee-btn btn-sm" href="<?php echo APP_URL; ?>/sportEquipments/delete/<?php echo $equipment->idImplemento; ?>">
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