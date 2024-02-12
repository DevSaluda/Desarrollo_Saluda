function CargaEmpleados(){
    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/Enfermeros.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  