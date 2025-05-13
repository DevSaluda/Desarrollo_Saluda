function CargaEmpleados(){
    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/Enfermeros.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  