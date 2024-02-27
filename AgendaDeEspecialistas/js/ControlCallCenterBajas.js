function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/CallCenterBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    