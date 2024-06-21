<?php require_once __DIR__ . '/../templates/header.php'; ?>


<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">

            <h3 class="page-title"> <?php echo (isset($data['title']) ? $data['title'] : 'Sin Titulo'); ?> <?= $data['icon_page'] ?></h3>

            <div class="ms-auto text-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= APP_URL ?>/dashboard">Menu</a></li>
                        <li class="breadcrumb-item">Empleado</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= $data['short_title'] ?>

                        </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Ingrese los Datos</h4>

                    <form action="<?php echo APP_URL; ?>/employees/update" method="POST">
                        <input type="hidden" name="idEmpleado" value="<?php echo $data['employee']->idEmpleado; ?>">

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $data['employee']->nombre; ?>" placeholder="Ingrese Nombre" required data-required data-letters data-capitalize>
                                <div class="invalid-feedback">
                                    Por favor, ingrese el nombre.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $data['employee']->apellido; ?>" placeholder="Ingrese Apellido" required data-required data-letters data-capitalize>
                                <div class="invalid-feedback">
                                    Por favor, ingrese el apellido.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="dni">DNI:</label>
                                <input type="text" name="dni" id="dni" class="form-control" value="<?php echo $data['employee']->dni; ?>" placeholder="Ingrese DNI" required data-required data-numeric data-maxlength="8" data-exactlength="8">
                                <div class="invalid-feedback">
                                    Por favor, ingrese un DNI válido de 8 dígitos numéricos.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $data['employee']->telefono; ?>" placeholder="Ingrese Teléfono" required data-required data-numeric data-maxlength="9" data-exactlength="9">
                                <div class="invalid-feedback">
                                    Por favor, ingrese un teléfono válido de 9 dígitos.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?php echo $data['employee']->email; ?>" placeholder="Ingrese Email" required data-required data-email>
                                <div class="invalid-feedback">
                                    Por favor, ingrese un email válido.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="direccion">Dirección:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $data['employee']->direccion; ?>" placeholder="Ingrese Dirección" required data-required>
                                <div class="invalid-feedback">
                                    Por favor, ingrese la dirección.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="salario">Salario:</label>
                                <input type="text" name="salario" id="salario" class="form-control" value="<?php echo $data['employee']->salario; ?>" placeholder="Ingrese Salario" required data-required data-currency>
                                <div class="invalid-feedback">
                                    Por favor, ingrese el salario con formato ####.##.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <label for="role">Rol:</label>
                                <select name="role" id="role" class="form-control" required data-required>
                                    <?php foreach ($data['roles'] as $role) : ?>
                                        <option value="<?php echo $role->idRol; ?>" <?php echo $data['employee']->idRol == $role->idRol ? 'selected' : ''; ?>>
                                            <?php echo $role->nombre; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Por favor, seleccione un rol.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-lg-5 mt-3">
                                <button type="submit" class="btn btn-primary mt-3">Actualizar Empleado</button>
                            </div>
                        </div>
                    </form>





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





<h1><?php echo isset($data['title']) ? $data['title'] : 'Editar Empleado'; ?></h1>

<form action="<?php echo APP_URL; ?>/employees/update" method="POST">
    <input type="hidden" name="idEmpleado" value="<?php echo $data['employee']->idEmpleado; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $data['employee']->nombre; ?>" required>
    <br>
    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" id="apellido" value="<?php echo $data['employee']->apellido; ?>" required>
    <br>
    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni" value="<?php echo $data['employee']->dni; ?>" required>
    <br>
    <label for="telefono">Teléfono:</label>
    <input type="text" name="telefono" id="telefono" value="<?php echo $data['employee']->telefono; ?>" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo $data['employee']->email; ?>" required>
    <br>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value="<?php echo $data['employee']->direccion; ?>" required>
    <br>
    <label for="salario">Salario:</label>
    <input type="text" name="salario" id="salario" value="<?php echo $data['employee']->salario; ?>" required>
    <br>
    <label for="role">Rol:</label>
    <select name="role" id="role" required>
        <?php foreach ($data['roles'] as $role) : ?>
            <option value="<?php echo $role->idRol; ?>" <?php echo $data['employee']->idRol == $role->idRol ? 'selected' : ''; ?>>
                <?php echo $role->nombre; ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>
    <button type="submit">Actualizar</button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>