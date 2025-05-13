function CargaChecadorEntradaDia(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/logsDia","",function(data){
      $("#EntradasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorEntradaDia();

  
