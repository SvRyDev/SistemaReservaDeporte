<?php require_once 'templates/header.php'; ?>



<br>
<br>
<br>
<br>
<br>

<div class="d-flex justify-content-center align-items-center bg-warning mb-4 mt-4 p-4" >
    <h1 class="text-center text-uppercase ">configuracion de cuenta</h1>
</div>


<section class="container my-5">
    <div class="card p-3">
        <form action="" id="updateClientForm">



            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-5">
                        <img src="<?php assets(); ?>/images/users/user-icon.png" class="img-thumbnail border-0" alt="">
                    </div>

                    <div class="col-lg-7">
                        <h4>Datos de Usuario</h4>
                        <div class="form-group mt-3">
                            <label for="nombre"><i class="mdi mdi-account-outline"></i> Nombre de Usuario:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Usuario" data-required data-letters data-capitalize>
                            <div class="invalid-feedback">
                                Por favor, ingrese el nombre de Usuario.
                            </div>
                        </div>


                        <div class="form-group mt-3">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Ingrese Teléfono" data-required data-numeric data-maxlength="9" data-exactlength="9">
                            <div class="invalid-feedback">
                                Por favor, ingrese un teléfono válido de 9 dígitos.
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese Email" data-required data-email>
                            <div class="invalid-feedback">
                                Por favor, ingrese un email válido.
                            </div>
                        </div>

                        <hr class="hr">
                        <div class="form-group col-lg-7 mt-2">
                            <label for="password"><i class="mdi mdi-lock-outline"></i> Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Nueva Contraseña (Opcional)" data-required data-minlength="6">
                            <div class="invalid-feedback">
                                Por favor, ingrese la contraseña.
                            </div>
                        </div>
                        <hr class="hr">
                        <div class="mt-3">
                            <button type="" id="btn_update_client" class="btn btn-success text-white"><i class="mdi mdi-lock-outline"></i> Actualizar Datos</button>
                        </div>
                        <hr class="hr">
                    </div>

                </div>
            </div>


        </form>
    </div>

    </div>

</section>


<?php require_once 'templates/footer.php'; ?>