function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/IntendenciaBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    