function CargaEmpleadosBajas(){
    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/RolesBajas.php","",function(data){
        $("#tablaEmpleadosBajas").html(data);
      })
      }
    CargaEmpleadosBajas();
  
    
    
    
  