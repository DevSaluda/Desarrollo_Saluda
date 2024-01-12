function CargaEmpleados(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/CallCenter.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  