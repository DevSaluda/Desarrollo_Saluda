function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/MedicosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  