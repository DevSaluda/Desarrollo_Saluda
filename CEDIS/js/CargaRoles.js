function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Roles.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  