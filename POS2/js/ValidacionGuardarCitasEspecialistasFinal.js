$('document').ready(function($){

    $("#AgendaExterno").validate({
        rules: {
            NombresExt:{
                required:true, 
            } ,
            TelExt:{
                required:true,
            },
            SucursalExt:{
                required:true,
            },
            EspecialidadExt:{
                required:true,
            },
            FechaExt:{
                required:true,
            },
            HorasExt:{
                required:true,
            },
            MedicoExt:{
                required:true,
            },
        },
        messages: {
            NombresExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Debes escribir el nombre del paciente por favor ",
            },
            TelExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
            SucursalExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
            EspecialidadExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            }, 
            FechaExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
            MedicoExt:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
        },
        submitHandler: submitForm    
    });

    function submitForm() {        
        // Obtener los datos del formulario
        var formData = $('#AgendaExterno').serializeArray();
        var formValues = {};
        $(formData).each(function(index, obj){
            formValues[obj.name] = obj.value;
        });

        // Obtener el texto seleccionado de los campos select
        var sucursalText = $('#sucursalExt option:selected').text();
        var especialidadText = $('#especialidadExt option:selected').text();
        var medicoText = $('#medicoExt option:selected').text();

        // Construir el mensaje de la alerta con los datos seleccionados
        var alertMessage = "<p>Confirmar los siguientes datos:</p><br>";
        alertMessage += "<p>Nombre: " + formValues['NombresExt'] + "</p><br>";
        alertMessage += "<p>Teléfono: " + formValues['TelExt'] + "</p><br>";
        alertMessage += "<p>Sucursal: " + sucursalText + "</p><br>";
        alertMessage += "<p>Especialidad: " + especialidadText + "</p><br>";
        alertMessage += "<p>Fecha: " + formValues['FechaExt'] + "</p><br>";
        alertMessage += "<p>Hora: " + formValues['HorasExt'] + "</p><br>";
        alertMessage += "<p>Médico: " + medicoText + "</p><br>";

        // Mostrar la alerta de Sweet Alert
        Swal.fire({
            title: "Confirmar datos",
            html: alertMessage,
            icon: "info",
            showCancelButton: true,
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar los datos al servidor
                $.ajax({
                    type: 'POST',
                    url: "Consultas/AgendaCitaEnSucursalExtV1.php",
                    data: $('#AgendaExterno').serialize(),
                    cache: false,
                    beforeSend: function(){    
                        $("#submit_Age").html("Un momento... <i class='fas fa-check'></i>");
                    },
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==250){
                            var modal_lv = 0;
                            $('.modal').on('shown.bs.modal', function (e) {
                                $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
                                $(e.currentTarget).css('zIndex',1052+modal_lv);
                                modal_lv++
                            });
                            $('.modal').on('hidden.bs.modal', function (e) {
                                modal_lv--
                            });    
                            $("#submit_Age").html("Algo no salió bien.. <i class='fas fa-exclamation-triangle'></i>");
                            $('#ErrorDupli').modal('toggle'); 
                            setTimeout(function(){ 
                                // acciones después de cierto tiempo
                            }, 2000); // abrir
                            setTimeout(function(){ 
                                $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
                            }, 3000); // abrir
                        } else if(dataResult.statusCode==200){
                            $("#submit_Age").html("Completo <i class='fas fa-check'></i>");
                            $("#CitaExt").removeClass("in");
                            $(".modal-backdrop").remove()
                            $("#CitaExt").hide();
                            $("#AgendaExterno")[0].reset();
                            $('#AgendamientoExitoso').modal('toggle')
                            setTimeout(function(){ 
                                $('#AgendamientoExitoso').modal('hide') 
                            }, 3000); // abrir
                            $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
                            CargaCitasEnSucursalExt();
                        } else if(dataResult.statusCode==201){
                            var modal_lv = 0;
                            $('.modal').on('shown.bs.modal', function (e) {
                                $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
                                $(e.currentTarget).css('zIndex',1052+modal_lv);
                                modal_lv++
                            });
                            $('.modal').on('hidden.bs.modal', function (e) {
                                modal_lv--
                            });    
                            $("#submit_Age").html("Algo no salió bien.. <i class='fas fa-exclamation-triangle'></i>");
                            $('#ErrorData').modal('toggle'); 
                            setTimeout(function(){ 
                                // acciones después de cierto tiempo
                            }, 2000); // abrir
                            setTimeout(function(){ 
                                $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
                            }, 3000); // abrir
                        }
                    }
                });
            }
        });

        // Retornar false para evitar el envío del formulario tradicional
        return false;
    }   
});
