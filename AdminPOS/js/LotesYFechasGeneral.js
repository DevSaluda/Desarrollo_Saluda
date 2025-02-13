function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/LotesYfechasGenerales.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();