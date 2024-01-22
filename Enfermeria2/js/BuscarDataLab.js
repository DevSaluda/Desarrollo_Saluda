// $(function() {
//     $("#codbarra").autocomplete({
//         source: "Consultas/BusquedaLabs.php",
//         minLength: 2,
//         appendTo: "#AgendaEnSucursalA",
//         select: function(event, ui) {
//             event.preventDefault();
//             let selectedCodbarra = ui.item.codbarra;
//             let selectedNombresLab = ui.item.nombresLab;
//             let currentNombresLab = $('#nombresLab').val();            
//             // Agregar el código y la descripción al textarea, separados por puntos
//             if (currentNombresLab.length > 0) {
//                 $('#nombresLab').val(currentNombresLab + '\n' + selectedCodbarra + ': ' + selectedNombresLab);
//             } else {
//                 $('#nombresLab').val(selectedCodbarra + ': ' + selectedNombresLab);
//             }
             

//             // Limpiar el campo de entrada
//             $('#codbarra').val('');
//         }
//     });          
// });

// $(function() {
//     $("#tel").on("blur", function() {
//         var phoneNumber = $(this).val();
        
//         // Verificar si el número de teléfono es válido (puedes agregar tu lógica de validación aquí)
//         var isValidPhoneNumber = validatePhoneNumber(phoneNumber);
        
//         if (isValidPhoneNumber) {
//             // Mostrar una alerta de confirmación utilizando SweetAlert
//             Swal.fire({
//                 title: "Confirmar",
//                 text: "¿El número de teléfono es correcto?",
//                 icon: "question",
//                 showCancelButton: true,
//                 confirmButtonText: "Sí",
//                 cancelButtonText: "No"
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     // El usuario confirmó que el número es correcto, aquí puedes realizar acciones adicionales si es necesario
//                 } else {
//                     // El usuario canceló la confirmación, puedes reiniciar el campo de teléfono si lo deseas
//                     $("#tel").val("");
//                 }
//             });
//         }
//     });
    
//     // Función de ejemplo para validar el número de teléfono
//     function validatePhoneNumber(phoneNumber) {
//         // Implementa tu lógica de validación aquí, por ejemplo, puedes verificar el formato del número
//         // y asegurarte de que cumpla con ciertos criterios antes de confirmar
//         return phoneNumber.length > 0; // En este ejemplo, simplemente verifica si el campo no está vacío
//     }
//     $(function() {
//         var addedItems = []; // Almacenar los elementos agregados al textarea
        
//         $("#codbarra").autocomplete({
//             source: "Consultas/BusquedaLabs.php",
//             minLength: 2,
//             appendTo: "#AgendaEnSucursalA",
//             select: function(event, ui) {
//                 event.preventDefault();
//                 var selectedCodbarra = ui.item.codbarra;
//                 var selectedNombresLab = ui.item.nombresLab;

//                 // Agregar el código y la descripción al array de elementos agregados
//                 addedItems.push(selectedCodbarra + ': ' + selectedNombresLab);

//                 // Actualizar el textarea con todos los elementos del array, separados por nuevas líneas
//                 $('#nombresLab').val(addedItems.join('\n'));
//                  // Actualizar el textarea con todos los elementos del array, separados por nuevas líneas
//                  $('#codigoOculto').val(addedItems.map(item => item.split(':')[0]).join(',')); // Actualizar el código oculto

//                 // Limpiar el campo de entrada
//                 $('#codbarra').val('');
//             }
//         });
        
//         // Agregar función para quitar el último elemento agregado
//         $("#removeLastItem").click(function() {
//             if (addedItems.length > 0) {
//                 addedItems.pop(); // Eliminar el último elemento del array
//                 $('#nombresLab').val(addedItems.join('\n')); // Actualizar el textarea
//                 $('#codigoOculto').val(addedItems.map(item => item.split(':')[0]).join(',')); // Actualizar el campo oculto
//             }
//         });
//     });
    
// });

// $(function() {
//     var addedItems = [];

//     $("#codbarra").on("select", function() {
//         var searchTerm = $(this).val().trim();
//         if (searchTerm.length >= 2) {
//             $.ajax({
//                 data: { term: searchTerm },
//                 dataType: "json",
//                 success: function(data) {
//                     $("#codbarra").empty().append('<option value="">Selecciona un producto</option>');
//                     data.forEach(function(item) {
//                         $("#codbarra").append('<option value="' + item.Cod_Barra + '">' + item.Nombre_Prod + '</option>');
//                     });
//                 }
//             });
//         }
//     });

//     $("#codbarra").change(function() {
//         var selectedCodbarra = $(this).val();
//         var selectedNombresLab = $("#codbarra option:selected").text();

//         if (selectedCodbarra !== '') {
//             addedItems.push({
//                 codbarra: selectedCodbarra,
//                 nombresLab: selectedNombresLab
//             });

//             $('#nombresLab').val(addedItems.map(item => item.nombresLab).join('\n'));
//             $("#codigoOculto").val(addedItems.map(item => item.codbarra).join(','));
//         }

//         $(this).val('');
//     });
//     $("#removeLastItem").click(function() {
//         if (addedItems.length > 0) {
//             addedItems.pop(); // Eliminar el último elemento del array
//             actualizarTextareas();
//         }
//     });

//     // Función para actualizar los textareas con los elementos del array
//     function actualizarTextareas() {
//         $('#nombresLab').val(addedItems.map(item => item.nombresLab).join('\n'));
//         $('#codigoOculto').val(addedItems.map(item => item.codbarra).join(','));
//     }
// });


$(function() {
    var addedItems = [];

    $("#codbarra").on("select", function() {
        var searchTerm = $(this).val().trim();
        if (searchTerm.length >= 2) {
            $.ajax({
                data: { term: searchTerm },
                dataType: "json",
                appendTo: "#AgendaEnSucursalA",
                success: function(data) {
                    $("#codbarra").empty().append('<option value="">Selecciona un producto</option>');
                    data.forEach(function(item) {
                        $("#codbarra").append('<option value="' + item.Cod_Barra + '">' + item.Nombre_Prod + '</option>');
                    });
                }
            });
        }
    });

    $("#codbarra").change(function() {
        var selectedCodbarra = $(this).val();
        var selectedNombresLab = $("#codbarra option:selected").text();

        if (selectedCodbarra !== '') {
            addedItems.push({
                codbarra: selectedCodbarra,
                nombresLab: selectedNombresLab
            });

            $('#nombresLab').val(addedItems.map(item => item.nombresLab).join('\n'));
            $("#codigoOculto").val(addedItems.map(item => item.codbarra).join(','));
        }

        $(this).val('');
    });
    $("#removeLastItem").click(function() {
        if (addedItems.length > 0) {
            addedItems.pop(); // Eliminar el último elemento del array
            actualizarTextareas();
        }
    });

    // Función para actualizar los textareas con los elementos del array
    function actualizarTextareas() {
        $('#nombresLab').val(addedItems.map(item => item.nombresLab).join('\n'));
        $('#codigoOculto').val(addedItems.map(item => item.codbarra).join(','));
    }
});