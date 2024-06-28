$(document).ready(function () {

    // Inicializa DataTable y guarda la referencia
    let table = $('#zero_config').DataTable({
        "processing": true,
        "serverSide": false,
        "autoWidth": false,
        "responsive": true,
        "ajax": {
            "url": "" + base_url + '/employees',
            "dataSrc": ""
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "columns": [
            { "title": "id", "data": "idEmpleado" },
            { "title": "Nombre", "data": "nombre" },
            { "title": "Apellidos", "data": "apellido" },
            { "title": "Dni", "data": "dni" },
            { "title": "Telefono", "data": "telefono" },
            { "title": "Email", "data": "email" },
            { "title": "Dirección", "data": "direccion" },
            { "title": "Salario (S./)", "data": "salario" },
            { "title": "Rol", "data": "rol_nombre" },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                            <button type="button" class="btn btn-warning text-white edit-employee-btn btn-sm" data-id="${data.idEmpleado}" data-bs-toggle="modal" data-bs-target="#eventModal"><i class="far fa-edit"></i>Editar</button>
                            <button type="button" class="btn btn-danger text-white delete-employee-btn btn-sm" data-id="${data.idEmpleado}" ><i class="fas fa-trash-alt"></i> Eliminar</a>
                        `;
                }
            }
        ]
    });


    $('body').on('click', '.add-employee-btn', function () {
        $('#employeeForm')[0].reset();
        $('#employeeId').val('');
        $('#employeeForm').attr('action', base_url + '/employees/new');
        $('#m-submitButton').text('Agregar Empleado');
        $('#m-submitButton').removeClass('btn-info').addClass('btn-success');
        $('#eventModalLabel').text('Nuevo Empleado');
        $('#password').prop('disabled', false);
        $('#password').attr('data-required', 'true').attr('data-minlength', '6');
        $('#l-label-enable-pass').hide();
        $('#enablePassword').prop('checked', true).prop('disabled', true);
        $('#employeeForm').find('input, select').removeClass('is-invalid is-valid'); // Clear validation classes from all fields
        $('#employeeForm').find('.invalid-feedback').text(''); // Clear all error messages
        $('#eventModal').modal('show');
    });


    $('body').on('click', '.edit-employee-btn', function (event) {
        const employeeId = $(this).data('id');
        const url = base_url + '/employees/edit/' + employeeId;

        // Mostrar el modal y el spinner, ocultar el contenido
        $('#eventModal').modal('show');
        $('#loadingSpinner').show();
        $('#eventDetails').hide();

        // Realizar la solicitud AJAX
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#idEmpleado').val(response.employee.idEmpleado);
                $('#nombre').val(response.employee.nombre);
                $('#apellido').val(response.employee.apellido);
                $('#dni').val(response.employee.dni);
                $('#telefono').val(response.employee.telefono);
                $('#email').val(response.employee.email);
                $('#direccion').val(response.employee.direccion);
                $('#salario').val(response.employee.salario);
                $('#role').val(response.employee.idRol);
                $('#password').val(''); // Clear password field
                $('#password').prop('disabled', true); // Disable password field
                $('#l-label-enable-pass').show();
                $('#enablePassword').prop('checked', false).prop('disabled', false); // Uncheck the enable password checkbox
                $('#password').removeAttr('data-required data-minlength'); // Remove validation attributes

                // Cambiar la acción del formulario a la de actualizar
                $('#employeeForm').attr('action', base_url + '/employees/update');
                $('#m-submitButton').text('Actualizar Empleado');
                $('#m-submitButton').removeClass('btn-success').addClass('btn-info');
                $('#eventModalLabel').text('Editar Empleado');

                // Ocultar el spinner y mostrar el contenido
                $('#loadingSpinner').hide();
                $('#eventDetails').show();
            },
            error: function (xhr, status, error) {
                console.error('Error al cargar los datos del empleado:', error);

                // Ocultar el spinner incluso si hay un error
                $('#loadingSpinner').hide();
                alert('Hubo un error al cargar los datos del empleado. Inténtelo de nuevo.');
            }
        });
    });

    // Restablecer el modal cuando se cierra
    $('#eventModal').on('hidden.bs.modal', function () {
        $('#employeeForm')[0].reset();
        $('#employeeId').val('');
        $('#password').prop('disabled', true);
        $('#enablePassword').prop('checked', false);
        $('#password').removeAttr('data-required data-minlength');
        $('#employeeForm').find('input, select').each(function () {
            $(this).removeClass('is-invalid is-valid'); // Remove validation styles
            $(this).closest('.form-group').find('.invalid-feedback').text(''); // Clear error messages
        });
    });

    // Manejar el checkbox para habilitar/deshabilitar el campo de la contraseña y sus validaciones
    $('#enablePassword').change(function () {
        if (this.checked) {
            $('#password').prop('disabled', false);
            $('#password').attr('data-required', 'true').attr('data-minlength', '6');
        } else {
            $('#password').prop('disabled', true);
            $('#password').val('');
            $('#password').removeAttr('data-required data-minlength');
            $('#password').removeClass('is-invalid is-valid'); // Remove validation styles
            $('#password').next('.invalid-feedback').text(''); // Clear error message
        }
    });



    // Manejar el envío del formulario con AJAX
    $('#employeeForm').on('submit', function (event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

        var form = $(this);
        var url = form.attr('action');

        // Verificar las validaciones antes de enviar el formulario
        if (!validateForm(form[0])) {
            return;
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: "Operacion Exitosa!",
                        text: response.message,
                        icon: "success"
                      });
                  //  alert(response.message);
                    $('#eventModal').modal('hide');

                    // Recargar la tabla
                    table.ajax.reload(null, false); // false para no cambiar la página actual

                } else {
                    Swal.fire({
                        icon: "error",
                        text: "Error al actualizar el empleado!",
                      });
                    console.log(response);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al actualizar los datos del empleado:', error);
                alert('Hubo un error al actualizar los datos del empleado. Inténtelo de nuevo.');
            }
        });
    });



    $('body').on('click', '.delete-employee-btn', function () {
        var employeeId = $(this).data('id');

        Swal.fire({
            title: '¿Eliminar registro?',
            text: "Registro a eliminar: Id de empleado " + employeeId,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteEmployee(employeeId);
            }
        });
    });

    // Función AJAX para eliminar empleado
    function deleteEmployee(employeeId) {
        $.ajax({
            url: base_url + '/employees/delete/' + employeeId,
            method: 'POST',
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire(
                        '¡Eliminado!',
                        'El empleado ha sido eliminado.',
                        'success'
                    );
                    table.ajax.reload(null, false); // Recargar la tabla
                } else {
                    Swal.fire(
                        'Error',
                        'Hubo un error al eliminar el empleado. Inténtelo de nuevo.',
                        'error'
                    );
                }
            },
            error: function (xhr, status, error) {
                console.error('Error al eliminar el empleado:', error);
                Swal.fire(
                    'Error',
                    'Hubo un error al eliminar el empleado. Inténtelo de nuevo.',
                    'error'
                );
            }
        });
    }









});
