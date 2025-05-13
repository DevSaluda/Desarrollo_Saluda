function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/EmpleadosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  