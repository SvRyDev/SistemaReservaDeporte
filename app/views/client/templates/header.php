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

    <!-- Header -->
    <header class="bg-primary text-white text-center">


        <!-- Navigation -->
        
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="navbar2" style="transition:.2s; top:0">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="#" style="position: relative;">
                    <img class="logo" src="<?php assets(); ?>/images/logo-icon.png" alt="Logo" style="position: relative; height: 50px; width: auto; transition: .5s;">

                </a>

                <script>
                    // Función para ajustar el tamaño del logo basado en la posición de desplazamiento
                    window.addEventListener('scroll', function() {
                                 var logo = document.querySelector('.logo');
                                 var navbar2 = document.querySelector('#navbar2');
                        if (window.scrollY > 0) {
                            logo.style.height = '30px'; // Ajusta el tamaño del logo cuando se desplaza hacia abajo
                            navbar2.style.opacity = '1';
     
                        } else {
                            logo.style.height = '40px'; // Restaura el tamaño del logo cuando está en la parte superior
                            navbar2.style.opacity = '.9';


                        }
                    });


                    ;
                </script>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                  
                        <li class="nav-item mx-2">
                            <a class="nav-link active" aria-current="page" href="<?php echo APP_URL; ?>/">Inicio </a>
                        </li>

                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/about">Nosotros</a>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/contact">Contacto</a>
                        </li>
                        <?php if (isset($_SESSION['user_name'])) : ?>
                            <?php if ($_SESSION['is_employee']) : ?>
                                <li class="nav-item  mx-2">
                                    <a class="btn  btn-primary btn-sm me-2" href="<?php echo APP_URL; ?>/dashboard">Dashboard</a>

                                </li>
                            <?php endif; ?>
                            <li class="nav-item  mx-2">
                                <a class="btn  btn-warning btn-sm me-2" href="<?php echo APP_URL; ?>/login/logout">Logout</a>

                            </li>
                        <?php else : ?>
                            <li class="nav-item  mx-2">
                                <a class="btn btn-primary btn-sm me-2" href="<?php echo APP_URL; ?>/login">Login</a>

                            </li>
                            <li class="nav-item  mx-2">
                                <a class="btn btn-warning btn-sm me-2" href="<?php echo APP_URL; ?>/register">Registrarse</a>

                            </li>
                        <?php endif; ?>
                        <li class="nav-item">

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <body>