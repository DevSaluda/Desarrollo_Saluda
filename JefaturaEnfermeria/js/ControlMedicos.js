function CargaEmpleados(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Medicos.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  