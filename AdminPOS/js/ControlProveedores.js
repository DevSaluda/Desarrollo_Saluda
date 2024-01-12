function CargaProveedores(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/Proveedores.php","",function(data){
      $("#tablaEmpleados").html(data);
    })
  
  }
  
  
  
  CargaProveedores();

  