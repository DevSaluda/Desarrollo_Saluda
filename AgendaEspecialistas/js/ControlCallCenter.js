function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/CallCenter.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  