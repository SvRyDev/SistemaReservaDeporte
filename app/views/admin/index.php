<?php require_once 'dashboard/templates/header.php'; ?>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
  
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card ">
                    <div class="box bg-warning text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-account-location"></i> 12
                        </h1>
                        <h6 class="text-white">Clientes Registrados</h6>
                    </div>
                </div>
            </div>
     
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card ">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-calendar-check"></i>
                        </h1>
                        <h6 class="text-white">Reservas</h6>
                    </div>
                </div>
            </div>
   
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card ">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-soccer"></i> 5
                        </h1>
                        <h6 class="text-white">Numero de Campos</h6>
                    </div>
                </div>
            </div>
   
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card ">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white">
                            <i class="mdi mdi-close"></i>
                        </h1>
                        <h6 class="text-white">Cancelaciones</h6>
                    </div>
                </div>
            </div>
      

        <br>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
            </table>
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

<?php require_once 'dashboard/templates/footer.php'; ?>