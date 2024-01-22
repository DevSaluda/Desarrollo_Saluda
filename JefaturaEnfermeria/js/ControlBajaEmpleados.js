function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/EmpleadosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  