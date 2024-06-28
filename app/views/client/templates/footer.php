    <!-- Footer -->
    <script> base_url = "<?php base_url();?>";
              id_cliente = "<? $_SESSION['user_id']?>"
  </script>
      <!-- Footer -->
  <footer class="bg-dark text-white mt-auto py-3">
    <div class="container">
      <div class="row">
        <!-- Información de la compañía -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h5 class="mb-3">Nuestra Compañía</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.</p>
        </div>
        <!-- Enlaces rápidos -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h5 class="mb-3">Enlaces Rápidos</h5>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white text-decoration-none">Inicio</a></li>
            <li><a href="#" class="text-white text-decoration-none">Sobre Nosotros</a></li>
            <li><a href="#" class="text-white text-decoration-none">Servicios</a></li>
            <li><a href="#" class="text-white text-decoration-none">Contacto</a></li>
          </ul>
        </div>
        <!-- Contacto -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h5 class="mb-3">Contacto</h5>
          <ul class="list-unstyled">
            <li><a href="mailto:info@ejemplo.com" class="text-white text-decoration-none">info@ejemplo.com</a></li>
            <li><a href="tel:+1234567890" class="text-white text-decoration-none">+123 456 7890</a></li>
            <li><a href="#" class="text-white text-decoration-none">123 Calle Principal, Ciudad</a></li>
          </ul>
        </div>
        <!-- Redes Sociales -->
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <h5 class="mb-3">Síguenos</h5>
          <div>
            <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
      <hr class="my-4 text-white">
      <div class="text-center">
        <p class="mb-0">&copy; 2024 Tu Compañía. Todos los derechos reservados.</p>
      </div>
    </div>
  </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    
    <?php
if ($data['module'] == 'ClientReservations') {
  ?>
  <!-- Calendar -->
  <script src="<?php assets(); ?>/libs/fullcalendar-6.1.14/dist/index.global.min.js"></script>
  <script src="<?php assets(); ?>/libs/fullcalendar-6.1.14/dist/index.global.js"></script>
  <script src="<?php dist(); ?>/js/modules/bd-wizard.js"></script>
  <script src="<?php dist(); ?>/js/modules/fullClientCalendar.js"></script>
  <script src="<?php dist(); ?>/js/modules/ClientReservationsFunctions.js"></script>
  <?php
};
?>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>




    </body>

    </html>

    