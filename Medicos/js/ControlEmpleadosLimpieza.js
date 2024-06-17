function CargaEmpleados(){
    $.get("https://saludapos.com/AdminPOS/Consultas/Intendentes.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  