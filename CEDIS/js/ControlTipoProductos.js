function CargaTiposProductos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TiposProductos.php","",function(data){
      $("#tablaTiposProductos").html(data);
    })

  }
  
  
  
  CargaTiposProductos();