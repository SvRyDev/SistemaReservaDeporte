$(document).ready(function () {
  // Función para cargar datos del combo box por AJAX
  function cargarDatosComboBox() {
    $.ajax({
      url: base_url + "/ClientReservations", // Ruta al archivo PHP que obtiene los datos
      method: "GET", // Método de la solicitud
      dataType: "json", // Tipo de datos esperados
      success: function (data) {
        // Limpiar el combo box antes de añadir nuevos elementos
        $("#deporte").empty();

        // Añadir una opción por defecto
        $("#deporte").append('<option value="">Selecciona una opción</option>');

        // Añadir opciones basadas en los datos recibidos
        $.each(data, function (index, item) {
          $("#deporte").append(
            '<option value="' +
              item.idTipoDeporte +
              '">' +
              item.nombre +
              "</option>"
          );
        });
      },
      error: function (xhr, status, error) {
        // Manejo de errores si la solicitud falla
        console.error("Error al cargar datos:" + data, status, error);
      },
    });
  }

  // Llamar a la función para cargar datos al cargar la página
  cargarDatosComboBox();

  $("#deporte").change(function () {
    var selectedValue = $(this).val();
    if (selectedValue) {
      $.ajax({
        url: base_url + "/ClientReservations/getSportFields/", // Ruta al archivo PHP que obtiene los datos
        type: "GET", // Método de la solicitud
        data: { id: selectedValue }, // Enviar el valor seleccionado como parámetro
        dataType: "json", // Tipo de datos esperados
        success: function (data) {
          console.log(data); // Verificar los datos en la consola
          console.log(data.length); // Verificar los datos en la consola
          // Limpiar el segundo combo box antes de añadir nuevos elementos
          $("#campodeportivo").empty();

          // Añadir una opción por defecto
          $("#campodeportivo").append(
            '<option value="" disabled selected>Selecciona una opción</option>'
          );

          // Añadir opciones basadas en los datos recibidos
          for (let i = 0; i < data.length; i++) {
            $("#campodeportivo").append(
              '<option value="' +
                data[i].idCampo +
                '">' +
                data[i].codigo +
                "   |    S/." +
                data[i].alquilerHora +
                "</option>"
            );
          }

          Window.myData = data;
        },
        error: function (xhr, status, error) {
          // Manejo de errores si la solicitud falla
          console.error("Error al cargar datos:", status, error);
        },
      });
    } else {
      // Limpiar el segundo combo box si no hay selección en el primero
      $("#campodeportivo").empty();
      $("#campodeportivo").append(
        '<option value="" disabled selected>Selecciona una opción</option>'
      );
    }
  });

  // Obtener la fecha actual y hora actual
  let today = new Date();
  let currentHour = today.getHours();
  let currentMinute = today.getMinutes();

  // Función para añadir opciones al combo box de días
  function addDaysOptions() {
    console.log("ejecutandose la funcoin ddaysoptions");
    let daysComboBox = $("#dias-reserva");
    for (let i = 0; i < 7; i++) {
      let nextDay = new Date(today);
      nextDay.setDate(today.getDate() + i);
      let day = nextDay.toLocaleDateString("es-ES", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
      });
      let option = $("<option></option>");
      option.val(nextDay.toISOString().split("T")[0]);
      option.text(day);
      daysComboBox.append(option);
    }
  }

  // Función para actualizar las opciones de hora según el día seleccionado
  function updateStartTimeOptions() {
    let daysComboBox = $("#dias-reserva");
    let selectedDay = new Date(daysComboBox.val());
    let isToday =
      selectedDay.toISOString().split("T")[0] ===
      today.toISOString().split("T")[0];
    let timeComboBox = $("#start-time");
    timeComboBox.empty();
    if (isToday) {
      for (let hour = currentHour; hour < 24; hour++) {
        for (
          let minute =
            hour === currentHour ? Math.ceil(currentMinute / 30) * 30 : 0;
          minute < 60;
          minute += 30
        ) {
          let time = ("0" + hour).slice(-2) + ":" + ("0" + minute).slice(-2);
          let option = $("<option></option>");
          option.val(time);
          option.text(time);
          timeComboBox.append(option);
        }
      }
    } else {
      for (let hour = 0; hour < 24; hour++) {
        for (let minute = 0; minute < 60; minute += 30) {
          let time = ("0" + hour).slice(-2) + ":" + ("0" + minute).slice(-2);
          let option = $("<option></option>");
          option.val(time);
          option.text(time);
          timeComboBox.append(option);
        }
      }
    }
  }

  // Función para generar opciones de duración
  function generateDurationOptions(maxHours) {
    let durationComboBox = $("#duration");
    durationComboBox.empty();

    for (let i = 1; i <= maxHours; i++) {
      let option = $("<option></option>");
      option.val(i);
      option.text(i + " Hora" + (i !== 1 ? "s" : ""));
      durationComboBox.append(option);
    }
  }

  function handleDurationChange() {
    let duration = parseInt($("#duration").val());
    console.log("Duración seleccionada:", duration, "horas");
  }

  // Iniciar la adición de opciones de días al cargar la página
  addDaysOptions();

  // Generar opciones de duración (máximo 5 horas)
  generateDurationOptions(5);

  // Actualizar las opciones de hora al cargar la página
  updateStartTimeOptions();

  // Manejar el cambio en el combo de días
  $("#dias-reserva").on("change", function () {
    updateStartTimeOptions();
  });

  $("#duration").on("change", function () {
    handleDurationChange();
  });

 
});
