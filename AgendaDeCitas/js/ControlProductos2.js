function CargaProductos(){


  $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();