function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/EnfermerosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  