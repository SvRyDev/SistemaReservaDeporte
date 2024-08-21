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
<style>
body{
    background-color: black;
}
    .bg-blur {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1; /* Colocar por debajo del contenido */
     
      background-image: url('<?= assets() ?>/images/background/background4.jpg');/* Cambia 'ruta/a/tu/imagen.jpg' por la ruta de tu imagen */
      background-size: cover;
      background-position: center;
      filter: blur(10px); /* Aplicar desenfoque al fondo */
    }


  </style>
<body>

<div class="bg-blur"></div>
    <style>
        /* Ajuste para el despliegue de submenús a la izquierda */
        .dropdown-menu-left {
            right: 0 !important;
            left: auto !important;
        }
    </style>
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
                            <a class="nav-link active" aria-current="page" href="<?php echo APP_URL; ?>/"><i class="mdi mdi-home"></i> Inicio </a>
                        </li>

                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/about"><i class="mdi mdi-information-outline"></i> Nosotros</a>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="<?php echo APP_URL; ?>/contact"><i class="mdi mdi-email-outline"></i> Contacto</a>
                        </li>
                        <?php if (isset($_SESSION['user_name'])) : ?>
                            <?php if ($_SESSION['is_employee']) : ?>
                                <li class="nav-item  mx-2">
                                    <a class="btn  btn-primary btn-sm me-2" href="<?php echo APP_URL; ?>/dashboard">Dashboard</a>

                                </li>
                            <?php endif; ?>


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="fs-2">
                                        <i class="mdi mdi-account-circle icon "></i>

                                    </span>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-left" aria-labelledby="navbarDropdown">
                                    <?php if (isset($_SESSION['user_name'])) { ?>
                                        <?php if (!$_SESSION['is_employee']) { ?>

                                            <li><a class="dropdown-item" href="<?= base_url() ?>/accountClient"><i class="mdi mdi-account-edit"></i> Mi perfil</a></li>
                                            <li><a class="dropdown-item" href="<?= base_url() ?>/accountReserves"><i class="mdi mdi-credit-card-outline"></i> Mis Reservas</a></li>

                                        <?php }  ?>
                                    <?php  }; ?>

                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>/login/logout"><i class="mdi mdi-logout"></i> Cerrar Sesion</a></li>
                                </ul>
                            </li>


                            <li class="nav-item">


                            </li>
                        <?php else : ?>
                            <li class="nav-item  mx-2">
                                <a class="btn btn-primary btn-sm me-2" href="<?php echo APP_URL; ?>/login">Login</a>

                            </li>
                            <li class="nav-item  mx-2">
                                <a class="btn btn-warning btn-sm me-2" href="<?php echo APP_URL; ?>/register">Registrarse</a>

                            </li>

                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <body>