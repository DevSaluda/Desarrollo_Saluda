function CargaEmpleados(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Empleados.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();

  
  
  
