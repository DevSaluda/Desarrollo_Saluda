function CargaProveedores(){


    $.post("https://saludapos.com/AdminPOS/Consultas/Proveedores.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaProveedores();

  