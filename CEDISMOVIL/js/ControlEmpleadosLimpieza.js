function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Intendentes.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  