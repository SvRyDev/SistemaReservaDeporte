let icalendar;
let eventosArray = [];
let eventoSolicitado;
let referenceEventId = "reference-event";
let solapamiento;

$(document).ready(function () {

  var form = $("#example-form");
  form.steps({
    headerTag: "h1",
    bodyTag: "fieldset",
    transitionEffect: "fade",
    autoFocus: true,
    labels: {
      previous: "Previous",
      next: "Next",
      finish: "Submit",
    },
    titleTemplate: "#title#",
    onStepChanged: function (event, currentIndex, newIndex) {
      if (currentIndex === 1) {
        initializeCalendar();
        if (icalendar && eventoSolicitado) {
          icalendar.addEvent(eventoSolicitado);
        }
        console.log(solapamiento);
      }
    },
    onStepChanging: function (event, currentIndex, newIndex) {
      if (currentIndex === 0 && newIndex === 1) {
        if (!$("#deporte").val() || !$("#campodeportivo").val()) {
          alert("Seleccione una de las opciones");
          return false;
        }
      }
      if (currentIndex === 1 && newIndex === 2) {
        if (solapamiento) {
          console.log("has marcado el paso 2");
          alert("¡Hay solapamiento de eventos! No puedes avanzar.");
          return false;
        }

        $("#text-fecha").text($("#dias-reserva option:selected").text());
        $("#text-hora").text(eventoSolicitado.title);
        $("#text-campo").text($("#campodeportivo option:selected").text());

        $("#text-estado").text("Pendiente de Confirmación");

        let opcionSeleccionada = $("#campodeportivo").val();

       
        // Mostrar el precio encontrado
      
          $("#costo-total").text(
            Window.myData[opcionSeleccionada-1].alquilerHora * $("#duration").val()
          );
      
      }

      if (currentIndex === 2 && newIndex === 3) {
      }
      return true;
    },
    onFinished: function (event, currentIndex) {
      // Aquí puedes manejar la acción final del formulario
      GuardarNuevaReserva();
   
    },
  });

  function initializeCalendar() {
    // Verificar si FullCalendar ya ha sido inicializado
    var calendarEl = document.getElementById("calendarClient");
    icalendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: "bootstrap5",
      height: "500px",
      initialView: "dayGridMonth",
      headerToolbar: false,

      locale: "es",
      views: {
        dayGridMonth: {
          buttonText: "Mes",
        },
        timeGridWeek: {
          buttonText: "Semana",
        },
        listWeek: {
          buttonText: "Lista Semanal",
        },
        listDay: {
          buttonText: "Lista Dia",
        },
      },
      events: eventosArray,

      navLinks: false, // can click day/week names to navigate views
    });

    icalendar.render();
  }

  function updateReferenceEvent() {
    let duration = document.getElementById("duration").value;
    let selectedDay = document.getElementById("dias-reserva").value;
    let selectedTime = document.getElementById("start-time").value;

    let startDate = new Date(selectedDay + "T" + selectedTime);
    let endDate = new Date(startDate.getTime() + duration * 60 * 60 * 1000);
    // Formatear el rango de tiempo
    let timeRangeStr = obtenerIntervaloHoraString(startDate, endDate);

    // Buscar y eliminar el evento de referencia anterior si existe
    let existingEvent = icalendar.getEventById(referenceEventId);
    if (existingEvent) {
      existingEvent.remove();
    }

    eventoSolicitado = {};
    // Crear y agregar el nuevo evento de referencia
    eventoSolicitado = {
      id: referenceEventId,
      title: `${timeRangeStr}`,
      start: startDate,
      end: endDate,
      allDay: false,
      color: "#25ac01",
      display: "block",
      // Otras propiedades del evento según necesites
    };
    solapamiento = false;
    icalendar.addEvent(eventoSolicitado);
    verificarSolapamiento(eventoSolicitado);
  }

  $("#duration").on("change", function () {
    updateReferenceEvent();
  });
  $("#dias-reserva").on("change", function () {
    updateReferenceEvent();
  });
  $("#start-time").on("change", function () {
    updateReferenceEvent();
  });

  $("#campodeportivo").change(function () {
    if ($("#calendarClient").hasClass("fc")) {
      // Si ya está inicializado, destruir la instancia existente
      icalendar.destroy();
    }
    var selectedValue = $(this).val();
    if (selectedValue) {
      $.ajax({
        url: base_url + "/ClientReservations/getAllAvailableReservations/", // Ruta al archivo PHP que obtiene los datos
        type: "GET", // Método de la solicitud
        data: { id: selectedValue }, // Enviar el valor seleccionado como parámetro
        dataType: "json", // Tipo de datos esperados
        success: function (data) {
          console.log("si funciono :D");
          eventosArray = [];
          data.forEach(function (evento) {
            eventosArray.push({
              id: evento.idReserva,
              title: `Rservado`,
              start: evento.fechaEntrada,
              end: evento.fechaSalida,
              allDay: false,
              color: "#010de6",
              display: "block",
            });
          });
        },
        error: function (xhr, status, error) {
          // Manejo de errores si la solicitud falla
          console.error("Error al cargar datos:", status, error);
        },
      });
    } else {
    }
  });

  function verificarSolapamiento(nuevaReserva) {
    console.log("verificando solapa");
    // Suponiendo que `todasLasReservas` es un array que contiene todas las reservas actuales
    console.log("solicitado" + eventoSolicitado);
    console.log("lista completa" + eventosArray);
    var evento = icalendar.getEventById(nuevaReserva.id);
    eventosArray.forEach(function (reservaExistente) {
      console.log("probando verificacion");
      // Verificar si hay solapamiento entre `nuevaReserva` y `reservaExistente`
      if (haySolapamiento(nuevaReserva, reservaExistente)) {
        // Mostrar una alerta al usuario
        console.log(evento);
        if (evento) {
          evento.remove();
          nuevaReserva.color = "#ff0000";
          icalendar.addEvent(nuevaReserva);
          solapamiento = true;
        } else {
        }
        return true; // Indicar que hay solapamiento y salir del bucle
      }
    });
    return false; // No hay solapamiento
  }

  function haySolapamiento(reserva1, reserva2) {
    // Convertir fechas a objetos Date para comparación
    var inicio1 = new Date(reserva1.start);
    var fin1 = new Date(reserva1.end);
    var inicio2 = new Date(reserva2.start);
    var fin2 = new Date(reserva2.end);

    // Verificar si hay solapamiento
    return inicio1 < fin2 && fin1 > inicio2;
  }

  function obtenerIntervaloHoraString(start, end) {
    let startTimeStr = start.toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
    });
    let endTimeStr = end.toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
    });
    return `${startTimeStr} - ${endTimeStr}`;
  }



  function GuardarNuevaReserva() {
    var reservaData = {
      idCampo:  $('#campodeportivo option:selected').val(), // Reemplaza con el valor adecuado
      idCliente:  id_cliente, // Reemplaza con el valor adecuado
      idEmpleado:  1, // Reemplaza con el valor adecuado
      detalle: "Reserva de prueba",
      fechaEntrada:  eventoSolicitado.start, // Reemplaza con el valor adecuado
      fechaSalida:  eventoSolicitado.end, // Reemplaza con el valor adecuado
      duracion:  $('#duration').val(), // Reemplaza con el valor adecuado
      precioTotal: $("#costo-total").val() , // Reemplaza con el valor adecuado
      
    };

    $.ajax({
      url: base_url+ "/ClientReservation/craeteReservation",
      type: "POST",
      data: reservaData,
      success: function (response) {
        alert("Reserva guardada con éxito:", response);
      },
      error: function (xhr, status, error) {
        alert("Error al guardar la reserva:", error);
      },
    });
  };
});
