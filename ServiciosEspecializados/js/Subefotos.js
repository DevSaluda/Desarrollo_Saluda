$(document).ready(function(e){
    $("#subefotos").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'Consultas/SubeFotos.php',
            data: new FormData(this),
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
            

success: function(){
    Swal.fire({
        icon: 'success',
        title: 'Se han guardado los datos',
        
        showConfirmButton: false,
        timer:3000,
      })
      $("#subefotos")[0].reset();
  
      CargaPacientes();

      $('#editModal2').modal('hide');
      $(".modal-backdrop").remove();
      $("#sube").hide();
     
    
},
error: function(){
    Swal.fire({
        icon: 'error',
        title: 'Algo salio mal..',
        
        showConfirmButton: false,
        timer:3000,
      })
     
    
},
});
});  
    
    //file type validation
    
});
