function CargaProductos(){


  $.post("https://saludapos.com/AgendaDeCitas/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();