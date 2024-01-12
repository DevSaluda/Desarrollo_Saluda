$('document').ready(function($){
    $.validator.addMethod("Sololetras", function(value, element) {
      return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
      $.validator.addMethod("Telefonico", function(value, element) {
        return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar numeros!");
      $.validator.addMethod("Correos", function(value, element) {
        return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo valido!");
      $.validator.addMethod("NEmpresa", function(value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
      $.validator.addMethod("Problema", function(value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
     
  
    $("#ProgramaEnSucursalesExt").validate({
    rules: {
           
      
            ProgramacionExt:{
                required:true,
          } ,      Especialidad:{
            required:true,
      } ,     
    
     
    },
    messages: {
            
      
            ProgramacionExt:{
                        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
                        },
           
                        Especialidad:{
                          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
                          },
             
                   
           
    },
        submitHandler: submitForm	
  });	   
    // hide messages 
   
   
    function submitForm() {	
     
        
  
        $.ajax({				
            type : 'POST',
            url: "Consultas/ProgramacionEnSucursalesExt.php",
            data: $('#ProgramaEnSucursalesExt').serialize(),
            cache: false,
            beforeSend: function(){	
      
              $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
        
                    
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
            $("#submit_registro").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
            $('#ErrorDupli').modal('toggle'); 
            setTimeout(function(){ 
        }, 2000); // abrir
        setTimeout(function(){ 
            $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
        }, 3000); // abrir
  
           
        }
       
        else if(dataResult.statusCode==200){
            
          $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
          $("#ProgramacionExt").removeClass("in");
          $(".modal-backdrop").remove();
          $("#ProgramacionExt").hide();
          $('#Exito').modal('toggle'); 
          $("#ProgramaEnSucursalesExt")[0].reset();
          $("#cargapordia").hide();
          $("#cargaporsemana").hide();
          $("#cargapormes").hide();
                $("#fechapordia").attr('name','');
                $("#fechapordiafin").attr('name','');
                $("#timecitas").attr('name','');
                $("#timeiniciadia").attr('name','');
                $("#timefindia").attr('name','');
                $("#tipodia").attr('name','');
                $("#fechasemana1").attr('name','');
                $("#fechasemana2").attr('name','');
                $("#timeiniciasemana").attr('name','');
                $("#timefinsemana").attr('name','');
                  $("#timecitassemana").attr('name','');
                  $("#tipoprogramasemana").attr('name','');
                  $("#fechasmes1").attr('name','');
                  $("#fechasmes2").attr('name','');
                  $("#timeiniciames").attr('name','');
                  $("#timefinmes").attr('name','');
                    $("#timecitasmes").attr('name','');
                    $("#tipoprogramames").attr('name','');
           
  
             $('#Exito').modal('toggle'); 
             setTimeout(function(){ 
                 $('#Exito').modal('hide') 
             }, 2000); // abrir
             CargaProgramaMedicosSucursalesExt();

            }
        else if(dataResult.statusCode==201){
          $("#submit_Age").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
          $('#ErrorData').modal('toggle'); 
        
      setTimeout(function(){ 
          $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
      }, 3000); // abrir
         
       
         }		
               
    
                
  
  
        }
      }); 
      return false;
    }   
  });