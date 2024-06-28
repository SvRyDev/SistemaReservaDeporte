<?php require_once 'templates/header.php'; ?>

<div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center" style="background-image: url('<?php assets(); ?>/images/background/background2.png'); background-size: cover; background-position: center;">

    <div class="text-center cover text-white fade-in">
        <img class="logo " src="<?php assets(); ?>/images/logo-icon.png" alt="Logo" style="position: relative; height: 160px; width: auto;">
        <h1 class="display-4 mb-4 cover-title">Montalvan</h1>
        <p class="lead mb-4 ">Reserva tu Espacio Deportivo Ahora</p>
        <a href="<?php base_url(); ?>/clientReservations" class="btn btn-warning btn-lg">Hacer mi Reserva</a>
        <p class="lead mb-4 mt-4 ">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?>.</p>


        <style>
            body,
            html {
                font-family: 'Roboto', sans-serif;
            }

            .cover {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                flex-direction: column;
                color: white;
                text-align: center;
            }

            .logo{
                animation: fadeInUp 1s ease-in-out;
            }

            .cover-title {
                font-size: 5em;
                font-family: 'Montserrat', sans-serif;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                background: rgba(0, 0, 0, 0.5);
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                animation: fadeInUp 2s ease-in-out;
            }

            @keyframes fadeInUp {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </div>
</div>

<style>
    @keyframes slide-in {
        0% {
            transform: translateX(-20%);
            opacity: 0;
        }

        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .fade-in {
        animation: slide-in 1s ease-out;
    }
</style>



<!-- Main Content -->
<div class="container my-5">

    <div class="row justify-content-between text-center">
        <div class="col-md-3 mb-5">
            <img src="<?= assets(); ?>/image/icons/icon01.svg" class="img-fluid" alt="Descripción de la imagen">
            <h2>Compromiso</h2>

            <div class="list-group">
                <p>
                    Nos dedicamos a brindar un servicio excepcional y a cumplir con nuestras promesas a nuestros clientes y comunidad.
                </p>

            </div>

        </div>
        <div class="col-md-3 mb-5">

            <img src="<?= assets(); ?>/image/icons/icon02.svg" class="img-fluid" alt="Descripción de la imagen">
            <h2>Innovación</h2>

            <div class="list-group">
                <p>
                    Buscamos constantemente nuevas formas de mejorar nuestros servicios y procesos para ofrecer la mejor experiencia posible.
                </p>

            </div>

        </div>

        <div class="col-md-3 mb-5">

            <img src="<?= assets(); ?>/image/icons/icon03.svg" class="img-fluid" alt="Descripción de la imagen">
            <h2></h2>

            <div class="list-group">
                <p>
                    Mantenemos altos estándares en todas nuestras instalaciones y servicios, asegurando un entorno seguro y agradable para nuestros usuarios.
                </p>

            </div>

        </div>



    </div>


</div>




<?php require_once 'templates/footer.php'; ?>