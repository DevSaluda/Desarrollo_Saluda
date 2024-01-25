$(document).ready(function(e){
    $("#ajax-form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'Consultas/GuardaUltra.php',
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
      $("#ajax-form")[0].reset();
  
      CargaPacientes();

      $("#AltaPaciente").removeClass("in");
      $(".modal-backdrop").remove();
      $("#AltaPaciente").hide();
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
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
});

       
