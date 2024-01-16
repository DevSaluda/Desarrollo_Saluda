function CargaProductos(){


  $.post("https://saludapos.com/CEDIS/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();