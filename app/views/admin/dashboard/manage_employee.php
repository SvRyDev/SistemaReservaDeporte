<?php require_once __DIR__ . '/../templates/header.php'; ?>



    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                
                <h3 class="page-title"><?php echo $data['icon_page'] .' ', (isset($data['title']) ? $data['title'] : 'Sin Titulo'); ?></h3>
                
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= APP_URL ?>/dashboard">Menu</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?= $data['short_title'] ?>

                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datos de la tabla</h5>
                        <a type="button" class="btn btn-success text-white" href="<?php echo APP_URL; ?>/employees/create"><i class="fas fa-user-plus"></i> Nuevo Empleado</a>
                        <br>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Dirección</th>
                                        <th>Salario</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['employees'] as $employee) : ?>
                                        <tr>
                                            <td><?php echo $employee->idEmpleado; ?></td>
                                            <td><?php echo $employee->nombre; ?></td>
                                            <td><?php echo $employee->apellido; ?></td>
                                            <td><?php echo $employee->dni; ?></td>
                                            <td><?php echo $employee->telefono; ?></td>
                                            <td><?php echo $employee->email; ?></td>
                                            <td><?php echo $employee->direccion; ?></td>
                                            <td><?php echo $employee->salario; ?></td>
                                            <td><?php echo $employee->rol_nombre; ?></td>
                                            <td>
                                                <a type="button" class="btn btn-warning btn-sm" href="<?php echo APP_URL; ?>/employees/edit/<?php echo $employee->idEmpleado; ?>"><i class="far fa-edit"></i> </a>
                                                <a type="button" class="btn btn-danger btn-sm" href="<?php echo APP_URL; ?>/employees/delete/<?php echo $employee->idEmpleado; ?>"><i class="fas fa-trash-alt"></i> </a>
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->


   
    <?php require_once __DIR__ . '/../templates/footer.php'; ?>