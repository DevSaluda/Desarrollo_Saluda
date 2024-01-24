function CargaEmpleados(){
    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Sucursales.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  