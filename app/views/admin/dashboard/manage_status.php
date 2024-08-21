<?php require_once __DIR__ . '/templates/header.php'; ?>
<?php require_once __DIR__ . '/modals/modal_status.php'; ?>


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
                            
                                </tr>
                            </thead>
                            <tbody>

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




<?php require_once __DIR__ . '/templates/header.php'; ?>

<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Estados'; ?></h1>

<a href="<?php echo APP_URL; ?>/state/create">Agregar Nuevo Estado</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Considerar Solapamiento</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['states'] as $state): ?>
        <tr>
            <td><?php echo $state->idEstado; ?></td>
            <td><?php echo $state->nombre; ?></td>
            <td><?php echo $state->descripcion; ?></td>
            <td><?php echo $state->considerar_solapamiento ? 'Sí' : 'No'; ?></td>
            <td>
                <a href="<?php echo APP_URL; ?>/state/edit/<?php echo $state->idEstado; ?>">Editar</a>
                <a href="<?php echo APP_URL; ?>/state/delete/<?php echo $state->idEstado; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/templates/footer.php'; ?>
