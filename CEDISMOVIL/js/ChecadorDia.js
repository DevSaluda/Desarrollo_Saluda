function CargaChecadorEntradaDia(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ChecadorDia","",function(data){
      $("#EntradasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorEntradaDia();

  
