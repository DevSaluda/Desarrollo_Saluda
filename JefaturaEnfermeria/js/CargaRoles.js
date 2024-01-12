function CargaEmpleados(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Roles.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  