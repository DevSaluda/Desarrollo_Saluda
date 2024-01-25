$(document).ready(function(e){
    $("#fupForm").on('submit', function(e){
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
        imageUrl: '../images/Procesa.gif',
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
  window.location.reload(true);
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
});
