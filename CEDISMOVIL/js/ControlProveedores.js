function CargaProveedores(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/Proveedores.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaProveedores();

  