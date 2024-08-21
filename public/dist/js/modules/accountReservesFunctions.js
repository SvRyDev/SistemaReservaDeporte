$(document).ready(function () {
  $.ajax({
    url: base_url + "/AccountReserves",
    type: "GET",
    dataType: "json",
    success: function (reservations) {
      var reservationsContainer = $("#reservations");
      reservations.forEach(function (reservation) {
        var reservationCard = `
                    <div class="col-md-4 mb-4">
                        <div class="card" style="overflow:hidden; border: none; box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;">
                            <div class="card-header bg-warning text-dark">
                               <b>Reserva #${reservation.idReserva}</b>
                            </div>
                            <div class="card-body">
                                
                                <p class="card-text">Campo: ${reservation.campo_codigo}</p>
                                <p class="card-text">Cliente: ${reservation.cliente_nombre}</p>
                                <p class="card-text">Empleado: ${reservation.empleado_nombre}</p>
                                <p class="card-text">Estado: <span class="badge rounded-pill" style="background-color:${reservation.estado_color};">${reservation.estado_nombre}</span></p>
                                <p class="card-text">Fecha de Entrada: ${reservation.fechaEntrada}</p>
                                <p class="card-text">Fecha de Salida: ${reservation.fechaSalida}</p>
                                <p class="card-text">Precio Total: ${reservation.precioTotal}</p>
                            </div>
                        </div>
                    </div>
                `;
        reservationsContainer.append(reservationCard);
      });
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener las reservas del cliente:", error);
    },
  });
});
