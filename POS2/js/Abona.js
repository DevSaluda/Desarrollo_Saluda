$('document').ready(function ($) {
    // $("#ActualizaSaldo").hide();
    // $("#AgregaEnCaja").hide();
    // $("#GeneraTicket").hide();
    // $("#GuardaReimpresionTicket").hide();
   
    $.validator.addMethod("Sololetras", function (value, element) {
      return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Telefonico", function (value, element) {
      return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar numeros!");
    $.validator.addMethod("Correos", function (value, element) {
      return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo valido!");
    $.validator.addMethod("NEmpresa", function (value, element) {
      return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Problema", function (value, element) {
      return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
  
  
    $("#AbonaCredito").validate({
      rules: {
  
  
        SaldoActual: {
          required: true,
        },
       Abono: {
          required: true,
        },
        SaldoNuevo:
        {
            required: true,
          },
          FechaAbono: {
            required: true,
          },
      },
      messages: {
        SaldoActual: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
        },
       Abono: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
        },
       
        SaldoNuevo:
        {
            required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
          },
          FechaAbono: {
            required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
          },
      },
      submitHandler: submitForm
    });
    // hide messages 
  
  
    function submitForm() {
  
  
  
      $.ajax({
        type: 'POST',
        url: "Consultas/AbonaCredito.php",
        data: $('#AbonaCredito').serialize(),
        cache: false,
        beforeSend: function () {
  
          $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
  
  
        },
        success: function (dataResult) {
          var dataResult = JSON.parse(dataResult);
  
          if (dataResult.statusCode == 250) {
            var modal_lv = 0;
            $('.modal').on('shown.bs.modal', function (e) {
              $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
              $(e.currentTarget).css('zIndex', 1052 + modal_lv);
              modal_lv++
            });
  
            $('.modal').on('hidden.bs.modal', function (e) {
              modal_lv--
            });
            $("#submit_registro").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
            $('#ErrorDupli').modal('toggle');
            setTimeout(function () {
            }, 2000); // abrir
            setTimeout(function () {
              $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
            }, 3000); // abrir
  
  
          }
  
          else if (dataResult.statusCode == 200) {
  
            $("#submit_registro").html("Enviado <i class='fas fa-check'></i>")
  
           
            $("#AperturaCredit").removeClass("in");
            $(".modal-backdrop").remove();
            $("#AperturaCredit").hide();
  
  
            $('#AbonoExito').modal('toggle');
            setTimeout(function () {
              $('#AbonoExito').modal('hide')
            }, 2000); // abrir
            $('#EnviaTicket').trigger("click");

        $.ajax({				
            type : 'POST',
            url: "Consultas/ActualizaSaldo.php",
            data: $('#ActualizaSaldo').serialize(),
            cache: false,
            beforeSend: function(){	
                $("#success").fadeOut();
                
                $("#submit").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
       
                    
            },
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==400){
                  var modal_lv = 0;
                  $('.modal').on('shown.bs.modal', function (e) {
                    $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
                    $(e.currentTarget).css('zIndex',1052+modal_lv);
                    modal_lv++
                  });
                  
                  $('.modal').on('hidden.bs.modal', function (e) {
                    modal_lv--
                  });	
                  
                 
                  $("#submit").html("Enviado <i class='fas fa-check'></i>")	
         
                 
                  $("#editModal").removeClass("in");
                  $(".modal-backdrop").remove();
                  $("#editModal").hide();
                
                  setTimeout(function(){ 
                    $('#ExitoActualiza').modal('toggle');  
                }, 3000); // abrir
                  setTimeout(function(){ 
                      $('#ExitoActualiza').modal('hide') 
                  }, 2000); // abrir
                  setTimeout(function(){ 
                  CargaCreditos();
                }, 3000); // abrir
                  
                 //  Solucionar muestra de modal de exito
                 $.ajax({				
                  type : 'POST',
                  url: "Consultas/AgregaEnCaja.php",
                  data: $('#AgregaEnCaja').serialize(),
                  cache: false,
                  beforeSend: function(){	
                      $("#success").fadeOut();
                      
                      $("#submit").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
             
                          
                  },
                  success: function(dataResult){
                      var dataResult = JSON.parse(dataResult);
                      if(dataResult.statusCode==800){
                        var modal_lv = 0;
                        $('.modal').on('shown.bs.modal', function (e) {
                          $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
                          $(e.currentTarget).css('zIndex',1052+modal_lv);
                          modal_lv++
                        });
                        
                        $('.modal').on('hidden.bs.modal', function (e) {
                          modal_lv--
                        });	
                        
                       
                        $("#submit").html("Enviado <i class='fas fa-check'></i>")	
               
                       
                        $("#editModal").removeClass("in");
                        $(".modal-backdrop").remove();
                        $("#editModal").hide();
                      
                        setTimeout(function(){ 
                          $('#ExitoActualiza').modal('toggle');  
                      }, 3000); // abrir
                        setTimeout(function(){ 
                            $('#ExitoActualiza').modal('hide') 
                        }, 2000); // abrir
                        setTimeout(function(){ 
                       
                      }, 3000); // abrir
                        
                       //  Solucionar muestra de modal de exito
                       $.ajax({				
                        type : 'POST',
                        url: "Consultas/ReimpresionesTickets.php",
                        data: $('#GuardaReimpresionTicket').serialize(), 
                        cache: false,
                        beforeSend: function(){	
                            $("#success").fadeOut();
                            
                            $("#submit").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                   
                                
                        },
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==900){
                              var modal_lv = 0;
                              $('.modal').on('shown.bs.modal', function (e) {
                                $('.modal-backdrop:last').css('zIndex',1051+modal_lv);
                                $(e.currentTarget).css('zIndex',1052+modal_lv);
                                modal_lv++
                              });
                              
                              $('.modal').on('hidden.bs.modal', function (e) {
                                modal_lv--
                              });	
                              
                             
                              $("#submit").html("Enviado <i class='fas fa-check'></i>")	
                     
                             
                              $("#editModal").removeClass("in");
                              $(".modal-backdrop").remove();
                              $("#editModal").hide();
                            
                              setTimeout(function(){ 
                                $('#ExitoActualiza').modal('toggle');  
                            }, 3000); // abrir
                              setTimeout(function(){ 
                                  $('#ExitoActualiza').modal('hide') 
                              }, 2000); // abrir
                              setTimeout(function(){ 
                             
                            }, 3000); // abrir
                              
                             //  Solucionar muestra de modal de exito
                                
                                    
                         }
                                
              
                            else if(dataResult.statusCode==901){
                                alert("Error occured !");
                                $("#CS").html("Enviar <i class='fas fa-paper-plane'></i>")	
                                // Reemplazar mensaje de error.
                             }		
                                   
                                    
                                    
                                
                            
                        }
                    }); 
                              
                   }
                          
        
                      else if(dataResult.statusCode==801){
                          alert("Error occured !");
                          $("#CS").html("Enviar <i class='fas fa-paper-plane'></i>")	
                          // Reemplazar mensaje de error.
                       }		
                             
                              
                              
                          
                      
                  }
              });
            
                        
             }
                    
  
                else if(dataResult.statusCode==401){
                    alert("Error occured !");
                    $("#CS").html("Enviar <i class='fas fa-paper-plane'></i>")	
                    // Reemplazar mensaje de error.
                 }		
                       
                        
                        
                    
                
            }
        });
  
            //  Solucionar muestra de modal de exito
  
  
          }
          else if (dataResult.statusCode == 201) {
            $("#submit_Age").html("Algo no salio bien.. <i class='fas fa-exclamation-triangle'></i>");
            $('#ErrorData').modal('toggle');
  
            setTimeout(function () {
              $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
            }, 3000); // abrir
  
  
          }
  
  
  
  
  
        }
      });
      return false;
    }
  });