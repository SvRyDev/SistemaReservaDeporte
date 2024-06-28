
//ADMIN SECTION
// public/js/modules/reservationsFunctions.js
const url_module = base_url + "/reservations/";



document.addEventListener('DOMContentLoaded', function() {
  // Restablecer el modal cuando se cierra
  $('#eventModal').on('hidden.bs.modal', function () {
    $('#loadingSpinner').css('display', 'block');
    $('#reservationContent').css('display', 'none');
    $('#eventDetails').html(''); // Restablecer el contenido
    $('#implementosList').empty(); // Restablecer la lista de implementos
  });
});

function fetchReservationDetails(url) {
  //console.log(url);
  $.ajax({
    url: url,
    method: 'GET',
    success: function(response) {
      // Actualiza el contenido del modal con los detalles del evento
      $('#eventModalLabel').text('Detalles de la Reserva');
      $('#eventDetails').html(
        `<p>Cliente: ${response.details.cliente_nombre}</p>
         <p>Fecha de Entrada: ${response.details.fechaEntrada}</p>
         <p>Fecha de Salida: ${response.details.fechaSalida}</p>
         <p>Detalle: ${response.details.detalle}</p>
         <p>Precio Total: ${response.details.precioTotal}</p>`
      );

      // Mostrar los implementos deportivos alquilados
      var implementosList = $('#implementosList');
      implementosList.empty();
      response.details.implementos.forEach(function(implemento) {
        implementosList.append(`<li>${implemento.nombre} - Cantidad: ${implemento.Cantidad}, Precio Total: ${implemento.PrecioTotal}</li>`);
      });

      // Ocultar el spinner y mostrar el contenido
      $('#loadingSpinner').css('display', 'none');
      $('#reservationContent').css('display', 'block');
    },
    error: function(xhr, status, error) {
      console.error('Error al obtener los detalles del evento:', error);
      
      // Ocultar el spinner incluso si hay un error
      $('#loadingSpinner').css('display', 'none');
    }
  });
}
