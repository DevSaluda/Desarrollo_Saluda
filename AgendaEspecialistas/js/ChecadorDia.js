function CargaChecadorEntradaDia(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/ChecadorDia","",function(data){
      $("#EntradasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorEntradaDia();

  
