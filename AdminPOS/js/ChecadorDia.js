function CargaChecadorEntradaDia(){


    $.get("https://saludapos.com/AdminPOS/Consultas/ChecadorDia","",function(data){
      $("#EntradasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorEntradaDia();

  
