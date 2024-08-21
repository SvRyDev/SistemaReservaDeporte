<?php require_once __DIR__ . '/templates/header.php'; ?>


<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">


        <div class="col-lg-12">
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

                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-12">
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
                        <!-- Modal -->
                        <div class="modal fade " id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div id="desc-info-reserve" class="modal-header">
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
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
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


<?php require_once __DIR__ . '/templates/footer.php'; ?>