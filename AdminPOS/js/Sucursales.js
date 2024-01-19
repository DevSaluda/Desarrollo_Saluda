function CargaEmpleados(){
    $.get("https://saludapos.com/AdminPOS/Consultas/Sucursales.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  