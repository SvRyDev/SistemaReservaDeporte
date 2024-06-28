<?php require_once __DIR__ . '/templates/header.php'; ?>


<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">


        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-6 ">
                            <h5></h5>
                            <a type="button" class="btn btn-success text-white" href="<?php echo APP_URL; ?>/reservations/create"><i class="fas fa-plus-circle"></i> Nueva Reserva</a>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Campo</th>
                                    <th>Fecha Entrada</th>
                                    <th>Fecha Salida</th>
                                    <th>Estado </th>
                                    <th>Pagos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['reservations'] as $reservation) : ?>

                                    <tr>
                                        <td><?php echo $reservation->idReserva; ?></td>
                                        <td><?php echo $reservation->cliente_nombre; ?></td>
                                        <td><?php echo $reservation->campo_codigo; ?></td>
                                        <td><?php echo $reservation->fechaEntrada; ?></td>
                                        <td><?php echo $reservation->fechaSalida; ?></td>
                                        <td><?php echo $reservation->estado_nombre; ?></td>
                                        <td><?php echo ucfirst($reservation->estado_pago); ?></td>
                                        <td class="d-flex">
                                            <a class="btn btn-warning btn-sm" href="<?php echo APP_URL; ?>/reservations/edit/<?php echo $reservation->encrypted_id; ?>"><i class="far fa-edit"></i> Editar</a>
                                            <a class="btn btn-danger btn-sm" href="<?php echo APP_URL; ?>/reservations/delete/<?php echo $reservation->idReserva; ?>"><i class="fas fa-trash-alt"></i> Eliminar</a>
                                            <a class="btn btn-secondary btn-sm" href="<?php echo APP_URL; ?>/payments/create/<?php echo $reservation->idReserva; ?>"><i class="fas fa-dollar-sign"></i> Realizar Pago</a>
                                            <a href="<?php echo APP_URL; ?>/reservations/updateState/<?php echo $reservation->idReserva; ?>">Actualizar Estado</a>
                                            <a href="<?php echo APP_URL; ?>/reservations/viewPayments/<?php echo $reservation->idReserva; ?>">Ver Pagos</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-6">
            <div class="row">
                <div class="card">


                    <div class="card-body b-l calender-sidebar">
                        <div id="calendar">

                        </div>

                        <script>
                            var reservationsData = <?php echo json_encode($data['reservations']); ?>;
                        </script>

                        <style>
                            .spinner-border {
                                display: none;
                                /* Ocultar el spinner por defecto */
                            }
                        </style>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary onclick-view-modal" data-id="<?= hmacEncrypt('1'); ?>" data-toggle="modal">
                            Launch demo modal <?= hmacDecrypt(hmacEncrypt(1)); ?>
                        </button>

                        <button type="button" class="btn btn-primary onclick-view-modal" data-url="/sistema-reserva-deporte/reservations/edit/2" data-toggle="modal">
                            Launch demo modal
                        </button>


                        <!-- Modal -->
                        <div class="modal fade " id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="eventModalLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="eventDetails">
                                        <div class="spinner-border" id="loadingSpinner" role="status">
                                            <span class="sr-only">Cargando...</span>
                                        </div>
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                </div>
                            </div>
                        </div>




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
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->








<h1><?php echo isset($data['title']) ? $data['title'] : 'Gestionar Reservas'; ?></h1>



<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Campo</th>
            <th>Cliente</th>
            <th>Empleado</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <th>Duración</th>
            <th>Precio Total</th>
            <th>Estado</th>
            <th>Estado de Pago</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['reservations'] as $reservation) : ?>
            <tr>
                <td><?php echo $reservation->idReserva; ?></td>
                <td><?php echo $reservation->campo_codigo; ?></td>
                <td><?php echo $reservation->cliente_nombre; ?></td>
                <td><?php echo $reservation->empleado_nombre; ?></td>
                <td><?php echo $reservation->fechaEntrada; ?></td>
                <td><?php echo $reservation->fechaSalida; ?></td>
                <td><?php echo $reservation->duracion; ?></td>
                <td><?php echo $reservation->precioTotal; ?></td>
                <td><?php echo $reservation->estado_nombre; ?></td>
                <td><?php echo ucfirst($reservation->estado_pago); ?></td>
                <td>
                    <a href="<?php echo APP_URL; ?>/reservations/edit/<?php echo $reservation->idReserva; ?>">Editar</a>
                    <a href="<?php echo APP_URL; ?>/reservations/delete/<?php echo $reservation->idReserva; ?>">Eliminar</a>
                    <a href="<?php echo APP_URL; ?>/payments/create/<?php echo $reservation->idReserva; ?>">Realizar Pago</a>
                    <a href="<?php echo APP_URL; ?>/reservations/updateState/<?php echo $reservation->idReserva; ?>">Actualizar Estado</a>
                    <a href="<?php echo APP_URL; ?>/reservations/viewPayments/<?php echo $reservation->idReserva; ?>">Ver Pagos</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/templates/footer.php'; ?>