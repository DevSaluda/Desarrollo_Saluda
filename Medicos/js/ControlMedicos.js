function CargaEmpleados(){
    $.get("https://saludapos.com/AdminPOS/Consultas/Medicos.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  