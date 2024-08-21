<div class="modal fade" id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success text-white" id="header-modal-form">
                <h5 class="modal-title" id="eventModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- FORMULARIO -->
            <form action="#" method="POST" id="sportsFieldsForm"> <!-- idFormulario -->
                <div class="modal-body" id="eventDetails">







                    <!-- INICIO - INPUTS DE FORMULARIO EN BASE AL MODULO -->
                    <input type="hidden" name="idCampo" id="idCampo"> <!-- idRol -->

                    <div class="row">

                        <div class="form-group col-lg-7 col-md-6 col-sm-12 mt-12">
                            <label for="codigo">Nombre:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Nombre" data-required data-capitalize>
                            <div class="invalid-feedback">
                                Por favor, ingrese el nombre.
                            </div>
                        </div>

                        <div class="form-group col-lg-5 col-md-6 col-sm-12 mt-12">
                            <label for="alquilerHora">Precio Alquiler por Hora (S/.)</label>
                            <input type="text" name="alquilerHora" id="alquilerHora" class="form-control" placeholder="#.00" data-required data-currency>
                            <div class="invalid-feedback">
                                Por favor, ingrese el valor con formato ##.##.
                            </div>
                        </div>


                        <div class="form-group col-lg-12 col-md-9 col-sm-8 mt-12">
                            <label for="idTipoDeporte">Tipo de Deporte:</label>
                            <select name="idTipoDeporte" id="idTipoDeporte" class="form-control" data-required>
                                <option value="" disabled selected>Seleccionar</option>
                                <?php foreach ($data['sports'] as $sports) : ?>
                                    <option value="<?php echo $sports->idTipoDeporte; ?>"><?php echo $sports->nombre; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor, seleccione el Deporte asociado.
                            </div>
                        </div>



                        <div class="form-group col-lg-12 col-md-6 col-sm-12 mt-12">
                            <input type="checkbox" name="disponible" id="disponible" class="form-check-input" checked>
                            <label class="" for="disponible">
                                Disponible
                            </label>
                            <div class="invalid-feedback">
                                Por favor, Indique correctamente.
                            </div>
                        </div>


                    </div>
                    <!-- FIN - INPUTS DE FORMULARIO-->












                </div>
                <div class="modal-footer">
                    <button type="submit" id="m-submitButton" class="btn btn-success text-white"></button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="mdi mdi-close-circle"></i> Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>