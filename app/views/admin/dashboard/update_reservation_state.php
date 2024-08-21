<?php require_once __DIR__ . '/templates/header.php'; ?>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
   

                    <form action="<?php echo APP_URL; ?>/reservations/updateState/<?php echo $data['reservation']->idReserva; ?>" method="POST">
                    <label for="">Id de Reserva: <?php echo $data['reservation']->idReserva; ?></label>   
                    <br> 
                    <label for="idEstado">Estado:</label>
                        <select class="form-control" name="idEstado" id="idEstado" required>
                            <?php foreach ($data['states'] as $state) : ?>
                                <option value="<?php echo $state->idEstado; ?>" <?php echo $data['reservation']->idEstado == $state->idEstado ? 'selected' : ''; ?>><?php echo $state->nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <button class="btn btn-info text-white" type="submit"><i class="mdi mdi-update"></i>
                         Actualizar Estado</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/templates/footer.php'; ?>