function CargaTiposProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/TiposProductos.php","",function(data){
      $("#tablaTiposProductos").html(data);
    })

  }
  
  
  
  CargaTiposProductos();