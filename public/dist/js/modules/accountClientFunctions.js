id_cliente_usuario = id_cliente;
console.log("asldhjaskj");
$(document).ready(function () {
  console.log("hola");
  // Hacer la solicitud AJAX para obtener los datos del cliente
  $.ajax({
    url: base_url + "/accountClient", // Reemplaza con la URL correcta
    type: "GET", // Puedes cambiar a POST si es necesario
    dataType: "json", // Tipo de datos esperados
    success: function (response) {
      console.log("ha validado");
      // Llenar los campos del formulario con los datos obtenidos
      $("#nombre").val(response.cliente_nombre);
      $("#telefono").val(response.cliente_telefono);
      $("#email").val(response.cliente_email);
      // No llenar la contraseña en esta etapa para evitar problemas de seguridad
    },
    error: function (xhr, status, error) {
      console.error("Error al obtener datos del cliente:", error);
      // Manejar el error según sea necesario
    },
  });

  $("#btn_update_client").click(function (e) {
    e.preventDefault(); // Evita que el formulario se envíe normalmente

    // Obtén los valores de los campos
    var nombre = $("#nombre").val();
    var telefono = $("#telefono").val();
    var email = $("#email").val();
    var contrasena = $("#password").val();
    var idUsuario = id_cliente_usuario; // Obtén el idUsuario del contexto PHP

    console.log("el id de usuario es" + idUsuario);
    // Realiza la llamada AJAX
    $.ajax({
      url: base_url + "/accountClient/update", // Reemplaza con la ruta correcta a tu controlador PHP
      method: "POST",
      data: {
        // Acción a ejecutar en tu controlador PHP
        idUsuario: idUsuario,
        nombre: nombre,
        telefono: telefono,
        email: email,
        contrasena: contrasena,
      },
      success: function (response) {
        // Maneja la respuesta del servidor si es necesario
        alert("Datos actualizados correctamente " + response.message);
        console.log(response.message);
      },
      error: function (xhr, status, error) {
        // Maneja errores de la llamada AJAX
        alert("Error al actualizar datos: " + error);
      },
    });
  });
});
