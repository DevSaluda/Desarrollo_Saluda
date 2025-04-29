$(document).ready(function(e){
    $("#subefotos").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData(this);
        // Mostrar en consola el valor de Estatus enviado
        console.log('Estatus enviado:', formData.get('Estatus'));
        $.ajax({
            type: 'POST',
            url: 'Consultas/SubeFotos.php',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
               Swal.fire({
        showConfirmButton: false,
        imageUrl: 'ComponentesEstudios/Verificando.gif',
        imageWidth: 900,
    
        imageAlt: 'Custom image',
        timer:6000,
      })
},
            
            success: function(data){
                // Mostrar respuesta del backend en consola
                console.log('Respuesta backend:', data);
                Swal.fire({
                    icon: 'success',
                    title: 'Se han guardado los datos',
                    showConfirmButton: false,
                    timer:3000,
                });
                $("#subefotos")[0].reset();
                CargaPacientes();
                $('#editModal2').modal('hide');
                $(".modal-backdrop").remove();
                $("#sube").hide();
            },
            error: function(xhr, status, error){
                console.log('Error backend:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Algo salio mal..',
                    showConfirmButton: false,
                    timer:3000,
                });
            },
        });
    });

    
    //file type validation
    
});
