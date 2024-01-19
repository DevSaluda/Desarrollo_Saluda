function CargaEmpleados(){
    $.get("https://saludapos.com/AdminPOS/Consultas/Enfermeros.php","",function(data){
        $("#tablaEmpleados").html(data);
      })
      }
    CargaEmpleados();
  
    
    
    
  