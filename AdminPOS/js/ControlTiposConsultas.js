function ServiciosCarga(){


    $.post("https://saludapos.com/AdminPOS/Consultas/TiposConsultas.php","",function(data){
      $("#TableConsultas").html(data);
    })

  }
  
  
  
  ServiciosCarga();