function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/Medicos.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  