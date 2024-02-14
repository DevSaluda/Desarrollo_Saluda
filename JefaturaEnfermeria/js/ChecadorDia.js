function CargaChecadorEntradaDia(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/ChecadorDia","",function(data){
      $("#EntradasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorEntradaDia();

  
