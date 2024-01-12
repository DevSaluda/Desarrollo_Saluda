function CargaEmpleados(){
    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Enfermeros.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  