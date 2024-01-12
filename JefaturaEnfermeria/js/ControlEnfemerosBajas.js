function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/EnfermerosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  