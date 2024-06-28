<?php require_once 'templates/header.php'; ?>
<br>
<br><br>
<br>
<br>



<!-- Título en Caja de Cover -->
<div class="d-flex justify-content-center align-items-center bg-dark text-white mb-4 mt-4" style="height: 200px;">
    <h1 class="text-center text-uppercase">Información de Contacto</h1>
</div>

<!-- Sección de Contacto -->
<section class="container my-5">

    <div class="row">

        <div class="col-md-12 mb-5">
        <h2>¡Nos encantaría saber de ti!</h2>
        <div class="list-group">
    
                  
        En Montalván, valoramos la comunicación directa con nuestros clientes. Si tienes alguna pregunta, comentario o necesitas más información sobre nuestros servicios, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte y asegurarnos de que tengas la mejor experiencia posible en nuestras instalaciones deportivas. Utiliza la información de contacto proporcionada o el formulario a continuación para enviarnos tu consulta. ¡Esperamos tener noticias tuyas pronto!

      
        </div>
        </div>

    </div>


    <div class="row">
        <!-- Información de Contacto -->
        <div class="col-md-6 mb-4">
            <h2>Contacto</h2>
            <div class="list-group">
                <div class="list-group-item">
                    <p><strong>Dirección:</strong> <?= DIRECCION_EMPRESA ?></p>

                </div>

                <div class="list-group-item">
                    <p><strong>Teléfono:</strong> <?= TELEFONO_EMPRESA ?></p>

                </div>
                <div class="list-group-item">
                    <p><strong>Email:</strong> <a href="<?= CORREO_EMPRESA ?>" class="text-decoration-none"><?= CORREO_EMPRESA ?></a></p>

                </div>
                <div class="list-group-item">
                    <p><strong>Horario:</strong> <?= HORARIO_ATENCION ?></p>

                </div>
            </div>
        </div>
        <!-- Extracto de Comentarios -->
        <div class="col-md-6">
            <h2>Ubicacion</h2>
            <div class="list-group">
                <div class="list-group-item">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1943.1580264850727!2d-76.39411998365989!3d-13.079145079467283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x910ff9312f9241cd%3A0x2a2198cff29a7e3c!2sCampo%20Sintetico%20Montalban!5e0!3m2!1ses!2spe!4v1719587902720!5m2!1ses!2spe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>



<?php require_once 'templates/footer.php'; ?>