function CargaEmpleados(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Empleados.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaEmpleados();

  
  
  
