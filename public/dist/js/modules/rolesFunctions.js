name_module_singular = "Rol";
id_form = "#rolForm";
base_url_module = base_url + "/roles";

icon_feather= "<i class='mdi mdi-feather'></i>";
icon_edit = "<i class='far fa-edit'></i>";
icon_delete = "<i class='fas fa-trash-alt'></i>"
icon_loading_spinner ="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>";





$(document).ready(function () {
  // READ - Inicializa DataTable y guarda la referencia
  let table = $("#zero_config").DataTable({
    processing: true,
    serverSide: false,
    autoWidth: false,
    responsive: true,
    ajax: {
      url: "" + base_url_module,
      dataSrc: "",
    },
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    },

    //INGRESAR LA ESTRUCTURA DEL MODULO
    columns: [
      { title: "id", data: "idRol" },
      { title: "Nombre", data: "nombre" },
      { title: "Descripción", data: "descripcion" },
 
      {
        data: null,
        render: function (data, type, row) {
          return `
                            <button type="button" class="btn btn-warning text-white mdl-edit-btn btn-sm" data-id="${data.idRol}" data-bs-toggle="modal" data-bs-target=""><span class="span_icon_edit">${icon_edit}</span><span class="d-none d-lg-inline">Editar</span></button>
                            <button type="button" class="btn btn-danger text-white mdl-delete-btn btn-sm" data-id="${data.idRol}" >${icon_delete}<span class="d-none d-lg-inline">Eliminar</span></button>
                        `;
        },
      },
    ],
  });

  //Reiniciar Modal Con espacios vacios
  $("body").on("click", ".mdl-add-btn", function () {
    $(id_form)[0].reset();
  
    $(id_form).attr("action", base_url_module + "/new");
    $("#m-submitButton").html("<i class='mdi mdi-plus-circle'></i>  Guardar");
    $("#m-submitButton").removeClass("btn-info").addClass("btn-success");
    $("#header-modal-form").removeClass("bg-info-gradient").addClass("bg-success-gradient");

    $("#eventModalLabel").html(icon_feather + " Nuevo "+name_module_singular);
    $("#password").prop("disabled", false);
    $("#password").attr("data-required", "true").attr("data-minlength", "6");
    $("#l-label-enable-pass").hide();
    $("#enablePassword").prop("checked", true).prop("disabled", true);
    $(id_form).find("input, select").removeClass("is-invalid is-valid"); // Clear validation classes from all fields
    $(id_form).find(".invalid-feedback").text(""); // Clear all error messages
    $("#eventModal").modal("show");
  });

  //Inicializar modal y cargar los datos (Para actualizar)
  $("body").on("click", ".mdl-edit-btn", function (event) {
    const dataId = $(this).data("id");
    const url = base_url_module + "/edit/" + dataId;

    // Mostrar el modal y el spinner, ocultar el contenido
    $(this).find('.span_icon_edit').html(icon_loading_spinner);
    $("#loadingSpinner").show();
    $("#eventDetails").hide();

    // Realizar la solicitud AJAX
    $.ajax({
      url: url,
      method: "GET",
      success: function (response) {
        //MODIFICAR EN BASE A LA ESTRUCTURA DEL MODULO
        $("#idRol").val(response.role.idRol);
        $("#nombre").val(response.role.nombre);
        $("#descripcion").val(response.role.descripcion);

        // Cambiar la acción del formulario a la de actualizar
        $(id_form).attr("action", base_url_module + "/update");
        $("#m-submitButton").html("<i class='mdi mdi-refresh'></i> Actualizar");
        $("#m-submitButton").removeClass("btn-success").addClass("btn-info");
        $("#header-modal-form").removeClass("bg-success-gradient").addClass("bg-info-gradient");
        $("#eventModalLabel").html(icon_feather + " Editar "+name_module_singular);
        $('.span_icon_edit').html(icon_edit);

        // Ocultar el spinner y mostrar el contenido
        $("#eventModal").modal("show");
        $("#loadingSpinner").hide();
        $("#eventDetails").show();
      },
      error: function (xhr, status, error) {
        console.error("Error al cargar los datos de "+name_module_singular+":", error);

        // Ocultar el spinner incluso si hay un error
        $("#loadingSpinner").hide();
        alert(
          "Hubo un error al cargar los datos de "+name_module_singular+". Inténtelo de nuevo."
        );
      },
    });
 
  });

  // Restablecer el modal cuando se cierra
  $("#eventModal").on("hidden.bs.modal", function () {
    $(id_form)[0].reset();
   
    $("#password").prop("disabled", true);
    $("#enablePassword").prop("checked", false);
    $("#password").removeAttr("data-required data-minlength");
    $(id_form)
      .find("input, select")
      .each(function () {
        $(this).removeClass("is-invalid is-valid"); // Remove validation styles
        $(this).closest(".form-group").find(".invalid-feedback").text(""); // Clear error messages
      });
  });


  //UPDATE & CREATE - Manejar el envío del formulario con AJAX
  $(id_form).on("submit", function (event) {
    event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

    var form = $(this);
    var url = form.attr("action");

    // Verificar las validaciones antes de enviar el formulario
    if (!validateForm(form[0])) {
      return;
    }

    $.ajax({
      url: url,
      method: "POST",
      data: form.serialize(),
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            title: "Operacion Exitosa!",
            text: response.message,
            icon: "success",
          });
          //  alert(response.message);
          $("#eventModal").modal("hide");

          // Recargar la tabla
          table.ajax.reload(null, false); // false para no cambiar la página actual
        } else {
          Swal.fire({
            icon: "error",
            text: "Error al actualizar "+name_module_singular+"!",
          });
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al actualizar los datos de "+name_module_singular+":", error);
        alert(
          "Hubo un error al actualizar los datos de "+name_module_singular+". Inténtelo de nuevo."
        );
      },
    });
  });

  //Modal de Confirmacion para Eliminar Datos
  $("body").on("click", ".mdl-delete-btn", function () {
    var dataId = $(this).data("id");

    Swal.fire({
      title: "¿Eliminar registro?",
      text: "Registro a eliminar: Id de "+name_module_singular+": " + dataId,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Eliminar",
    }).then((result) => {
      if (result.isConfirmed) {
        deleteData(dataId);
      }
    });
  });

  //DELETE - Función AJAX para eliminar 
  function deleteData(dataId) {
    $.ajax({
      url: base_url_module + "/delete/" + dataId,
      method: "POST",
      success: function (response) {
        if (response.status === "success") {
          Swal.fire("¡Eliminado!", "El "+name_module_singular+" ha sido eliminado.", "success");
          table.ajax.reload(null, false); // Recargar la tabla
        } else {
          Swal.fire(
            "Error",
            "Hubo un error al eliminar el registro. Inténtelo de nuevo.",
            "error"
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error al eliminar el registro:", error);
        Swal.fire(
          "Error",
          "Hubo un error al eliminar el registro. Inténtelo de nuevo.",
          "error"
        );
      },
    });
  }
});
