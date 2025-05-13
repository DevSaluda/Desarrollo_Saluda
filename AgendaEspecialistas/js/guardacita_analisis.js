function Procesando(){
    Swal.fire({
        showConfirmButton: false,
        imageUrl: '../images/Procesa.gif',
        imageWidth: 900,
    
        imageAlt: 'Custom image',
        timer:6000,
      })
}
$(document).ready(function($){
 
  
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
 
        $("#error").hide();
 
        //name required
        var nombres = $("input#nombre_apellidos").val();
       
        if(nombres == ""){
            Swal.fire({
                icon: 'error',
                title: 'Tienes campos vacios',
                timer: 2000,
                showConfirmButton: false
              })
              $("input#nombre_apellidos").focus();
              
                       return false;
        }
 
      
       
      
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/CitaAnalisis.php",
            data: $(this).serialize(), // get all form field value in serialize form
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
 
    return false;
    });

       
