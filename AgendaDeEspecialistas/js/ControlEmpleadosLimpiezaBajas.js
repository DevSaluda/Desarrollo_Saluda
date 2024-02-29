function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/IntendenciaBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    