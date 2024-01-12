function CargaChecadorEntradaDia(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ChecadorDia","",function(data){
      $("#EntradasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorEntradaDia();

  
