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
                            <h4>Editar Rol</h4>
                            <form action="<?php echo APP_URL; ?>/roles/update" method="POST">
                                <input type="hidden" name="idRol" value="<?php echo $data['role']->idRol; ?>">
                                <label for="nombre">Nombre:</label>
                                <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $data['role']->nombre; ?>" required>
                                <br>
                                <label  for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" required><?php echo $data['role']->descripcion; ?></textarea>
                                <br>
                                <button class="btn btn-info text-white" type="submit">Actualizar Rol</button>
                            </form>


                        </div>


                    </div>

                    <br>

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