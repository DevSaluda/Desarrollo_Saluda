
function readRecords() {
    $.get("Consultas/MuestraAnalisis.php", {}, function (data, status) {
        $("#records_content").html(data);
    });
}

function Procesando(){
    Swal.fire({
        showConfirmButton: false,
        imageUrl: '../images/Procesa.gif',
        imageWidth: 900,
    
        imageAlt: 'Custom image',
        timer:6000,
      })
      $("#add_new_record_modal").modal("hide");
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
            url: "Consultas/AgregaAnalisis.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){    
               
                Swal.fire({
                    icon: 'success',
                    title: 'Se han guardado los datos',
                    
                    showConfirmButton: false,
                    timer:3000,
                    
                  })
               
                 
                  readRecords();
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

       
