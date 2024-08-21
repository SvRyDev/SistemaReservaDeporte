<div class="modal fade" id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success text-white" id="header-modal-form">
                <h5 class="modal-title" id="eventModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- FORMULARIO -->
            <form action="#" method="POST" id="paymentMethodForm"> <!-- idFormulario -->
                <div class="modal-body" id="eventDetails">







                    <!-- INICIO - INPUTS DE FORMULARIO EN BASE AL MODULO -->
                    <input type="hidden" name="idMetodoPago" id="idMetodoPago"> <!-- idRol -->

                    <div class="row">

                        <div class="form-group col-lg-7 col-md-6 col-sm-12 mt-12">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" data-required data-letters data-capitalize>
                            <div class="invalid-feedback">
                                Por favor, ingrese el nombre.
                            </div>
                        </div>

                        <div class="form-group col-lg-5 col-md-12 col-sm-12 mt-12">
                            <label for="codigo">Codigo:</label>
                            <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Descripcion" data-required>
                            <div class="invalid-feedback">
                                Por favor, ingrese un codigo.
                            </div>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 mt-12">
                            <label for="notas">Descripcion:</label>
                            <input type="text" name="notas" id="notas" class="form-control" placeholder="Descripcion" data-required>
                            <div class="invalid-feedback">
                                Por favor, ingrese la descripcion.
                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mt-12">
                            <label for="tarifa_adicional">Tarifa Adicional: (S/.)</label>
                            <input type="text" name="tarifa_adicional" id="tarifa_adicional" class="form-control" placeholder="#.00" data-required data-currency>
                            <div class="invalid-feedback">
                                Por favor, ingrese el valor con formato ##.##.
                            </div>
                        </div>
                        <div class="form-group col-lg-8 col-md-6 col-sm-12 mt-12">
                            <label for="url_integracion">Url de Integracion:</label>
                            <input type="text" name="url_integracion" id="url_integracion" class="form-control" placeholder="http://" >
                            <div class="invalid-feedback">

                            </div>
                        </div>

                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mt-12">
                            <input type="checkbox" name="disponible" id="disponible" class="form-check-input" checked>
                            <label  class="" for="disponible">
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