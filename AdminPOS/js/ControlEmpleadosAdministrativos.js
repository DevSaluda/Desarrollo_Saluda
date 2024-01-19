function CargaEmpleados(){


    $.get("https://saludapos.com/AdminPOS/Consultas/EmpleadosAdministrativos.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();

  
  
  
