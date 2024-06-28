<?php require_once __DIR__ . '/templates/header.php'; ?>



<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title font-weight-bold">Ingrese los Datos</h4>

                    <form action="<?php echo APP_URL; ?>/employees/store" method="POST">

                        <div class="row">
                            <div class="form-group col-lg-4 col-md-6 mt-2">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control font-weight-bold" placeholder="Ingrese nombre" data-required data-letters data-capitalize>
                                <div class="invalid-feedback">
                                    Por favor, ingrese el nombre.
                                </div>
                            </div>
                            <div class="form-group col-lg-5 col-md-6 mt-2">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingrese apellido" data-required data-letters data-capitalize>
                                <div class="invalid-feedback">
                                    Por favor, ingrese el apellido.
                                </div>
                            </div>

                            <div class="form-group col-lg-3 col-md-3 col-sm-6  mt-2">
                                <label for="dni">DNI:</label>
                                <input type="text" name="dni" id="dni" class="form-control" placeholder="Ingrese DNI" data-required data-numeric data-maxlength="8" data-exactlength="8">
                                <div class="invalid-feedback">
                                    Por favor, ingrese un DNI válido de 8 dígitos numéricos.
                                </div>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-6 mt-2">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese Teléfono" data-required data-numeric data-maxlength="9" data-exactlength="9">
                                <div class="invalid-feedback">
                                    Por favor, ingrese un teléfono válido de 9 dígitos.
                                </div>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 mt-2">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese Email" data-required data-email>
                                <div class="invalid-feedback">
                                    Por favor, ingrese un email válido.
                                </div>
                            </div>

                            <div class="form-group col-lg-6 mt-2">
                                <label for="direccion">Dirección:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese Dirección" data-required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese la dirección.
                                </div>
                            </div>

                            <div class="form-group col-lg-2 col-md-3 col-sm-4 mt-2">
                                <label for="salario">Salario (S./):</label>
                                <input type="text" name="salario" id="salario" class="form-control" placeholder="0.00" data-required data-currency>
                                <div class="invalid-feedback">
                                    Por favor, ingrese el salario con formato ####.##.
                                </div>
                            </div>

                            <div class="form-group col-lg-3 col-md-9 col-sm-8 mt-2">
                                <label for="role">Rol:</label>
                                <select name="role" id="role" class="form-control" data-required>
                                    <option value="" disabled selected>Seleccionar</option>
                                    <?php foreach ($data['roles'] as $role) : ?>
                                        <option value="<?php echo $role->idRol; ?>"><?php echo $role->nombre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione un rol.
                                </div>
                            </div>


                            <div class="form-group col-lg-7 mt-2">
                                <label for="password">Contraseña:</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese Contraseña" data-required data-minlength="6">
                                <div class="invalid-feedback">
                                    Por favor, ingrese la contraseña.
                                </div>
                            </div>





                        </div>



                        <div class="row">






                        </div>

                        <div class="form-row">

                        </div>

                        <div class="form-row">

                        </div>

                        <div class="form-row">

                        </div>

                        <div class="form-row">

                        </div>

                        <div class="form-row">

                        </div>

                        <div class="form-row">

                        </div>

                        <button type="submit" class="btn btn-info mt-3">Agregar Empleado</button>
                    </form>

                    <label for="datetimeInput">Fecha y Hora</label>
                    <input type="datetime-local" class="form-control" id="datetimeInput" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese una fecha y hora válida.
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

<?php require_once __DIR__ . '/../dashboard/templates/footer.php'; ?>