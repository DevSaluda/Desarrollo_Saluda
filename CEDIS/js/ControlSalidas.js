function CargaSalidas(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Salidas.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaSalidas();

  
  