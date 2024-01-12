function CargaSalidasI(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Salidas.php","",function(data){
      $("#tablaEmpleadosSalidas").html(data);
    })
  
  }
  
  
  
  CargaSalidasI();

  
  