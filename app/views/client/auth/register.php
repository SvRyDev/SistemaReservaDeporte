<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($data['title']) ? $data['title'] : 'Página de Inicio'; ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= APP_URL ?>/public/assets/images/logo-icon.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.css">
    <link rel="stylesheet" href="<?php dist() ?>/css/bd-wizard.css">
</head>


<body>




    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background-image: url('<?php assets(); ?>/images/background/ball.png'); background-size: cover; background-position: center;">


        <div class="container">
            <form action="<?php echo APP_URL; ?>/register/store" method="POST">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                        <div class="mb-5">
                            <div class="text-center mb-4">
                                <a href="<?php base_url(); ?>">
                                    <img src="<?php assets(); ?>/images/logo-icon.png" alt="BootstrapBrain Logo" style="height:150px">
                                </a>
                            </div>
                            <h4 class="text-center mb-4 text-white">Sistema de Reservas Moltalvan</h4>
                            <div class="text-center">

                            </div>
                        </div>
                        <div class="card border border-light-subtle rounded-4">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <form action="#!">
                                    <p class="text-center mb-4">Ingresa con tu correo Electronico</p>
                                    <?php if (isset($data['error'])) : ?>
                                        <p style="color: red;"><?php echo $data['error']; ?></p>
                                    <?php endif; ?>
                                    <div class="row gy-3 overflow-hidden">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                                <label for="nombre" class="form-label">Nombre</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" name="telefono" id="telefono" placeholder="123456789" required>
                                                <label for="telefono" class="form-label">Telefono</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                                                <label for="email" class="form-label">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                                                <label for="password" class="form-label">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                                                <label class="form-check-label text-secondary" for="remember_me">
                                                    Keep me logged in
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-warning btn-lg" type="submit"> 
                                                    <span class="ms-2 fs-6">
                                                        <i class="mdi mdi-door-open"></i> 

                                                    Registrar Cuenta
                                                    
                                                    </span>
                                                </button>
                                            </div>

                                            <div class="d-grid mt-2">
                                                <a href="<?= base_url() ?>/login" class="btn btn-dark btn-lg">
                                           

                                                    
                                                    
                                                    <span class="ms-2 fs-6">
                                                        <i class="mdi mdi-login"></i> 
                                                        Ya tienes cuenta? Inicia Sesión</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>

    <!-- Login 6 - Bootstrap Brain Component -->





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>




</body>

</html>