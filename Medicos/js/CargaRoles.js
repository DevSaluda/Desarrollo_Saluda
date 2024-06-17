function CargaEmpleados(){
    $.get("https://saludapos.com/AdminPOS/Consultas/Roles.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  