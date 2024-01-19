function CargaEmpleados(){


    $.get("https://saludapos.com/AdminPOS/Consultas/Empleados.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();

  
  
  
