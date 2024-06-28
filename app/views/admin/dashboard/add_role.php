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
                            <h4>Nuevo Rol</h4>
                            <form action="<?php echo APP_URL; ?>/roles/store" method="POST">
                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                        <input class="form-control" type="text" name="nombre" id="nombre" required>

                                </div>
                                <br>

                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control"  name="descripcion" id="descripcion" required></textarea>
                                <br>
                                <button class="btn btn-success text-white" type="submit">Agregar Rol</button>
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