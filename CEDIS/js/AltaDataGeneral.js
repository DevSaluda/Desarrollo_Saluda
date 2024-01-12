$('document').ready(function($){
    $.validator.addMethod("Sololetras", function(value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras");
      $.validator.addMethod("Telefonico", function(value, element) {
        return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar numeros!");
      $.validator.addMethod("Correos", function(value, element) {
        return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo valido!");
     
      $.validator.addMethod("Problema", function(value, element) {
        return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
      $.validator.addMethod("Curps", function(value, element) {
        return this.optional(element) || /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/
        .test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Verifique el curp");
      $.validator.addMethod("RFCC", function(value, element) {
        return this.optional(element) || /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Verifique el RFC");
      $.validator.addMethod("NSSS", function(value, element) {
        return this.optional(element) ||/^(\d{2})(\d{2})(\d{2})\d{5}$/.test(value);
      }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Verifique el NSS");
     
     
    $("#Personal").validate({
		rules: {
		nombres: {
                required: true,
                minlength: 2,
                maxlength: 40,
                Sololetras: "",
                   },
                   curp:{
                    required:true,
                    minlength:18,
                    maxlength:18,
                    Curps:"",
                   },
                    rfc:{
                    required:true,
                    minlength:10,
                    maxlength:13,
                   RFCC:"",
                   },
                   fechan:{
                    required:true,
                },
                    sexo:{
                        required:true,
                    },
                    estadoc:{
                        required:true,
                    },
                    correo: {
                        required: true,
                        minlength:5,
                        maxlength:30,
                        Correos: "",
                         },
                         tel1:{
                             required:true,
                             minlength:10,
                             maxlength:10,
                             Telefonico:"",
                         },
                         tel2:{
                            required:true,
                            minlength:10,
                            maxlength:10,
                            Telefonico:"",
                        },
                        nss:{
                            required:true,
                            minlength:11,
                            maxlength:11,
                            NSSS:"",
                        },
                        alergias:{
                            required:true,
                            maxlength:50,
                            Sololetras:"",
                        },
                        sangre:{
                            required:true,
                        },
                        cruzamientos:{
                            required:true,
                            minlength:3,
                            maxlength:40,
                        },
                        colonia:{
                            required:true,
                            minlength:5,
                            maxlength:50,
                        },
                           cp:{
                            required:true,
                            minlength:5,
                            maxlength:5,
                           }, 
                           
                           calle:{
                               required:true,
                           },
                         
                        folioc:{
                            required:true,
                        },
                        estado:{
                            required:true,
                        },
                        localidad:{
                            required:true,
                        },
                        municipio:{
                            required:true,
                        },
                        familiar1:{
                            required:true,
                            minlength:1,
                            maxlength:50,
                            Sololetras:"",
                        },
                        p1:{
                            required:true,
                        },
                        telf1:{
                            required:true,
                            minlength:10,
                            maxlength:10,
                            Telefonico:"",
                        }
		},
		messages: {
            
			nombres:{
              required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El limite es 55 caracteres",
              minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Un nombre no puede tener solo 1 caracter"
            
             },
             curp:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>  El curp debe tener 18 caracteres"   
             },
             rfc:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El limite es 13 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>  El rfc debe tener 12 o 13 caracteres"   
             },
             fechan:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },
               sexo:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
               },

            estadoc:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
            correo:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i>El correo no puede tener solo 5 caracteres"
            },
            tel1:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El numero de telefono no puede tener mas de 10 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Debes ingresar los 10 caracteres del numero de telefono"
            },
            tel2:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El numero de telefono no puede tener mas de 10 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Debes ingresar los 10 caracteres del numero de telefono"
            },
              nss:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El numero de seguro social no puede tener mas de 11 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Debes ingresar los 10 caracteres del numero de seguro social"
              },
              alergias:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Limite de caracteres sobrepasado",
              
              },
              sangre:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              },
              cruzamientos:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Minimo 3 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Limite de caracteres sobrepasado"   
              },
              colonia:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Minimo 5 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Limite de caracteres sobrepasado"   
              },
              cp:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Minimo 5 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa los datos del CP"   
              },
              estado:{
                  required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                },
              municipio:{
                  required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                },
              localidad:{
                  required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
            },
              calle:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              },
              folioc:{
                  required:"<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              },
              familiar1:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El limite es 55 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Un nombre no puede tener solo 1 caracter"
              },
              p1:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
              },
              telf1:{
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido ",
                maxlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> El numero de telefono no puede tener mas de 10 caracteres",
                minlength: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Debes ingresar los 10 caracteres del numero de telefono"
              }
		},
        submitHandler: submitForm	
	});	   
    // hide messages 
   
 
    function submitForm() {		
		
        var nombres = $('#nombres').val();
        var curp =$('#curp').val();
        var fechan =$('#fechan').val();
        var rfc =$('#rfc').val();
           var sexo =$('#sexo').val();
        var estadoc=$('#estadoc').val();
        var correo=$('#correo').val();
        var tel1=$('#tel1').val();
        var tel2=$('#tel2').val();
        var nss =$('#nss').val();
        var alergias=$('#alergias').val();
        var sangre=$('#sangre').val();
        var calle =$('#calle').val();
        var next=$('#next').val();
        var nint=$('#nint').val();
        var cruzamientos =$('#cruzamientos').val();
        var colonia=$('#colonia').val();
        var cp=$('#cp').val();
        var estador=$('#estador').val();
        var municipior=$('#municipior').val();
        var localidadr=$('#localidadr').val();
        var empresa =$('#empresa').val();
        var folioc=$('#folioc').val();
        var usuario= $('#usuario').val();	
        var familiar1=$('#familiar1').val();
        var familiar2=$('#familiar2').val();
        var p1=$('#p1').val();
        var p2=$('#p2').val();
        var telf1=$('#telf1').val();
        var telf2=$('#telf2').val();
        var sistema = $('#sistema').val();
       
		$.ajax({				
			type : 'POST',
			url  : 'Consultas/GuardaPersonal.php',
			data: {
              nombres:nombres,
              curp:curp,
              fechan:fechan,
              rfc:rfc,
               sexo:sexo,
              estadoc:estadoc,
              correo:correo,
              tel1:tel1,
              tel2:tel2,
              nss:nss,
              alergias:alergias,
              sangre:sangre,
              calle:calle,
              next:next,
              nint:nint,
              cruzamientos:cruzamientos,
              colonia:colonia,
              cp:cp,
              estador:estador,
              municipior:municipior,
              localidadr:localidadr,
              empresa:empresa,
              folioc:folioc,
              usuario:usuario,
              familiar1:familiar1,
              familiar2:familiar2,
              p1:p1,
              p2:p2,
              telf1:telf1,
              telf2:telf2,
              sistema:sistema
             


            },
            cache: false,
            beforeSend: function(){	
				$("#success").fadeOut();
				
				$("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
        var delay = alertify.get('notifier','delay');
        alertify.set('notifier','delay', 2);
        alertify.success('Estamos procesando la solicitud... : ' + alertify.get('notifier','delay') + ' seconds');
        alertify.set('notifier','delay', delay);
                    
			},
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    
                     $("#submit_registro").html("Enviado <i class='fas fa-check'></i>")	
                     $("#Exito").show();
                    //  Solucionar muestra de modal de exito
                        $("#Personal")[0].reset();	
                        $("#submit_registro").html("Un Momento <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                           $("#submit_registro").html("Datos almacenados <i class='fas fa-cloud-upload-alt'></i>")
                           CargaDataPersonal();	
                           $("#Exito").hide();
                           
                }
                else if(dataResult.statusCode==201){
                    alert("Error occured !");
                    $("#CS").html("Enviar <i class='fas fa-paper-plane'></i>")	
                    // Reemplazar mensaje de error.
                 }		
                       
						
                        
					
				
			}
		});
		return false;
	}   
});