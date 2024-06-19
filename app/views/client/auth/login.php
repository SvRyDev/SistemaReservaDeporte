<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <link rel="stylesheet" href="<?php echo STYLE_URL; ?>/global.css" />
  <link rel="stylesheet" href="<?php echo STYLE_URL; ?>/login.css" />
</head>

<body>
  <div class="login">

  <div class="card">
    <div>
      <h1><?php echo NOMBRE_EMPRESA; ?></h1>
    </div>
  <div class="imagelogin"></div>
    <?php if (isset($data['error'])) : ?>
      <p style="color: red;"><?php echo $data['error']; ?></p>
    <?php endif; ?>
    <form action="<?php echo APP_URL; ?>/login/authenticate" method="post">
    <button type="submit">Iniciar Sesión</button>
      <div>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
      </div>
      
    </form>
  </div>

    


  </div>
</body>

</html>