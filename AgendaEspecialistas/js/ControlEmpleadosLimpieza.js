function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/Intendentes.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  