// public/js/modules/fullcalendarConfig.js
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
  
    // Transformar los datos de reservas al formato que espera FullCalendar
    var events = reservationsData.map(function(reservation) {
      return {
        title: 'Reserva ' + reservation.estado_nombre + ":  " + reservation.fechaEntrada + " " + reservation.fechaSalida,
        start: reservation.fechaEntrada, 
        end: reservation.fechaSalida,
        backgroundColor: reservation.estado_color,
        borderColor: reservation.estado_color,
        //className: 'onclick-view-modal',
        extendedProps: {
          dataId: reservation.encrypted_id
        }
      };
    });
  
    var calendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: 'bootstrap5',
      height: '50vh',
      initialView: 'listMonth',
      locale: 'es',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth, listWeek, listMonth'
      },
      views: {
        dayGridMonth: {
          buttonText: 'Mes'
        },
        listWeek: {
          buttonText: 'Semana'
        },
        listMonth: {
          buttonText: 'Lista Mes'
        }
      },
      navLinks: true, // can click day/week names to navigate views
      events: events,
      eventDidMount: function(info) {
        // Agregar clase y atributo data-id a cada evento
        var eventElement = info.el;
        eventElement.setAttribute('reservation-id', info.event.extendedProps.dataId);
        eventElement.setAttribute('data-toggle', 'modal');
        eventElement.style.cursor = 'pointer'; // Cambiar el cursor a puntero
  
        // Adjuntar el evento de clic
        eventElement.addEventListener('click', function(event) {
          event.preventDefault(); // Evitar la acción predeterminada del navegador
          var id = eventElement.getAttribute('reservation-id');
          var url = base_url +"/reservations/edit/" + id;
          
  

          $('#reservationContent').hide();
  
          fetchReservationDetails(url);

                    // Mostrar el modal y el spinner, ocultar el contenido
                    $('#eventModal').modal('show');
                    $('#loadingSpinner').show();
        });
      },
      eventClick: function(info) {
        info.jsEvent.preventDefault(); // Prevent the default browser action
      }
    });
  
    calendar.render();
   
  });
  