function CargaEmpleados(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/Empleados.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();

  
  
  
