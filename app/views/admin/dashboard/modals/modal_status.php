<div class="modal fade" id="eventModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success text-white" id="header-modal-form">
                <h5 class="modal-title" id="eventModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- FORMULARIO -->
            <form action="#" method="POST" id="statusForm">  <!-- idFormulario -->
                <div class="modal-body" id="eventDetails">





                    <!-- INICIO - INPUTS DE FORMULARIO EN BASE AL MODULO -->
                    <input type="hidden" name="idEstado" id="idEstado"> <!-- idRol -->

                    <div class="row">

                        <div class="form-group col-lg-8 col-md-12 col-sm-12 mt-12">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" data-required data-letters data-capitalize>
                            <div class="invalid-feedback">
                            Por favor, ingrese el nombre.
                            </div>
                        </div>
                        
                        <div class="form-group col-lg-4 col-md-6 col-sm-12 mt-12">
                            <label for="color">Color de Estado:</label>
                            <input type="color" class="form-control form-control-color" id="color" name="color" value="#aaa" title="Choose your color" style="padding: 0.375rem;">
                           
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 mt-12">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripción" data-required data-letters>
                            <div class="invalid-feedback">
                            Por favor, ingrese la Descripcion.
                            </div>
                        </div>
                        

                        <div class="form-group col-lg-12 col-md-6 col-sm-12 mt-12">
                            <input type="checkbox" name="considerar_solapamiento" id="considerar_solapamiento" class="form-check-input" checked>
                            <label class="" for="considerar_solapamiento">
                                Permitir Solapamiento
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