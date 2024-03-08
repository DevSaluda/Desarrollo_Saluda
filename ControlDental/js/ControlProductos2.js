function CargaProductos(){


  $.post("https://saludapos.com/AdminPOS/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();