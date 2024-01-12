function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Sucursales.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  