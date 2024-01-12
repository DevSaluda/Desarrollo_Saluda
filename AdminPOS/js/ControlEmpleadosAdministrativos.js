function CargaEmpleados(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/EmpleadosAdministrativos.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();

  
  
  
