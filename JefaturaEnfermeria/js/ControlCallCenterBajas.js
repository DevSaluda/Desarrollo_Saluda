function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CallCenterBaja.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  