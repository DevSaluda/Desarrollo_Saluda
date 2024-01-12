function CargaEmpleados(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Empleados.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();

  
  
  
