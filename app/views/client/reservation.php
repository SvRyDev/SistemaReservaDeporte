<?php require_once 'templates/header.php'; ?>
<br>
<br>
<br>
<br>




<main class="my-5">
  <div class="container mt-5">


    <form id="example-form" class="" action="<?= base_url(); ?>" method='POST'>
      <h1>
        <div class="media d-flex text-decoration-none">
          <div class="bd-wizard-step-icon" id="wizard-0"><i class="mdi mdi-soccer"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Elige tu cancha</div>
            <div class="bd-wizard-step-subtitle">Paso 1</div>
          </div>
        </div>
      </h1>
      <fieldset>
        <div class="d-flex justify-content-center align-items-center bg-warning mb-4 p-1 ">
          <h3 class="text-center text-uppercase">Elige tu cancha</h3>
        </div>
        <legend></legend>
        <div class="row">
        <div class="form-group col-lg-6 mt-2">
          <label for="deporte">Deporte:</label>
          <select class="form-control" id="deporte" name="deporte">
            <option value="" disabled selected>Selecciona una opción</option>
          </select>
          <div class="invalid-feedback">
            Por favor, ingrese el salario con formato ####.##.
          </div>
        </div>
        <div class="form-group col-lg-6 mt-2">
          <label for="campodeportivo">Campo Disponibles:</label>
          <select class="form-control" id="campodeportivo" name="campodeportivo">
            <option value="" disabled selected>Selecciona una opción</option>
          </select>
          <div class="invalid-feedback">
            Por favor, ingrese el salario con formato ####.##.
          </div>
        </div>

        </div>
        


      </fieldset>

      <h1>
        <div class="media d-flex">
          <div class="bd-wizard-step-icon" id="wizard-1"><i class="mdi mdi-clock"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Elige la Fecha</div>
            <div class="bd-wizard-step-subtitle">Paso 2</div>
          </div>
        </div>
      </h1>


      <fieldset>

        <div class="row">
          <div class="col-lg-4">
            <legend>Horarios Disponibles</legend>
            <div class="form-group col-lg-12 mt-2">
              <label for="dias-reserva">Seleccione un día:</label>
              <select id="dias-reserva" class="form-control" name="dias-reserva">
              </select>
              <div class="invalid-feedback">
                Por favor, ingrese el salario con formato.
              </div>
            </div>
            <div class="form-group col-lg-12 mt-2">
              <label for="start-time">Seleccione la hora de inicio:</label>
              <select id="start-time" class="form-control" name="start-time">
              </select>
              <div class="invalid-feedback">
                Por favor, ingrese el salario con formato.
              </div>
            </div>
            <div class="form-group col-lg-12 mt-2">
              <label for="duration">Total de Horas:</label>
              <select id="duration" class="form-control" name="duration">
              </select>
              <div class="invalid-feedback">
                Por favor, ingrese el salario con formato.
              </div>
            </div>
          </div>


          <div class="col-lg-8 mt-4" id="calendarClient"></div>
        </div>
      </fieldset>

      <h1>
        <div class="media d-flex">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-format-list-bulleted"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Resumen de la Reserva</div>
            <div class="bd-wizard-step-subtitle">Paso 3</div>
          </div>
        </div>
      </h1>
      <fieldset>
        <legend>Informacion de tu Reserva</legend>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Detalles de la Reserva</h5>
            <ul class="list-group">
              <li class="list-group-item">Fecha: <span id="text-fecha"> </span></li>
              <li class="list-group-item">Hora: <span id="text-hora"> </span></li>
              <li class="list-group-item">Campo: <span id="text-campo"> </span></li>
              <li class="list-group-item">Cliente: <span id="text-cliente"> </span><?= isset($_SESSION['user_name']) ? ($_SESSION['user_name']) : "Desconocido"; ?></li>
              <li class="list-group-item">Telefono: <span id="text-telefono"><?= isset($_SESSION['user_phone']) ? ($_SESSION['user_phone']) : "Desconocido"; ?></span></li>
              <li class="list-group-item">Correo Electrónico: <span id="text-email"> </span><?= isset($_SESSION['user_email']) ? ($_SESSION['user_email']) : "Desconocido"; ?></li>
              <li class="list-group-item">Estado: <span id="text-estado"> </span></li>
            </ul>
            <hr>
            <div class="d-flex justify-content-end">
              <div>
                <b>
                  Total: S./<span id="costo-total"></span>
                </b>
              </div>
            </div>
          </div>
        </div>

      </fieldset>
      <h1>
        <div class="media d-flex">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-cash"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Realizar Pago</div>
            <div class="bd-wizard-step-subtitle">Paso 4</div>
          </div>
        </div>
      </h1>
      <fieldset>
        <legend>Culmina tu Reserva</legend>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Metodos de Pago</h5>
            <div class="row">

              <div class="form-group col-lg-3 rounded mx-2 btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn bg-success active">
                  <input type="radio" name="options" id="option1" autocomplete="off" checked>
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-cash"></i>
                  </h1>
                  <h6 class="text-white">Pago Efectivo</h6>
                </label>
              </div>

              <div class="form-group col-lg-3 rounded mx-2 btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn active" style="background-color: #720e9e;">
                  <input type="radio" name="options" id="option2" autocomplete="off">
                  <h1 class="font-light text-white">
                    <i class="mdi mdi-qrcode-scan"></i>
                  </h1>
                  <h6 class="text-white">Yape</h6>
                </label>
              </div>

            </div>
            <hr>
            <div class="d-flex justify-content-end">
              <div>
              </div>
            </div>
          </div>
        </div>
      </fieldset>
    </form>




  </div>



</main>







<?php require_once 'templates/footer.php'; ?>