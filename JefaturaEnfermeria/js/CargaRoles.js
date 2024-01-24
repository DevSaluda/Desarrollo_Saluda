function CargaEmpleados(){
    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Roles.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  