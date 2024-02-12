function CargaProductos(){


  $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/Productos2.php","",function(data){
    $("#tablaProductos").html(data);
  })

}



CargaProductos();