function CargaEmpleados(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Sucursales.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  