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
      
        <div class="row justify-content-center">
          <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
            <div class="mb-5">
              <div class="text-center mb-4">
                <a href="<?php base_url() ?>">
                  <img src="<?php assets(); ?>/images/logo-icon.png" alt="BootstrapBrain Logo" style="height:150px">
                </a>
              </div>
              <h4 class="text-center mb-4 text-white">Sistema de Reservas Moltalvan</h4>
              <div class="text-center">
                <a href="#!" class="btn bsb-btn-2xl btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                    <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                  </svg>
                  <span class="ms-2 fs-6">Sign in with Google</span>
                </a>
              </div>
            </div>


            <form action="<?php echo APP_URL; ?>/login/authenticate" method="POST">
            <div class="card border border-light-subtle rounded-4">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <form action="#!">
                  <p class="text-center mb-4">Inicia sesión y reserva en segundos</p>
                  <?php if (isset($data['error'])) : ?>
                    <p style="color: red;"><?php echo $data['error']; ?></p>
                  <?php endif; ?>
                  <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
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
                          Mantener Sesion Iniciada
                        </label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button class="btn btn-warning btn-lg" type="submit">Ingresar</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            </form>


            <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-4">
              <a href="#!" class="link-secondary text-decoration-none">Create new account</a>
              <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
            </div>
          </div>
        </div>
    
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