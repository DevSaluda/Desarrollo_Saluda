function CargaEmpleadosBajas(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/MedicosBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  