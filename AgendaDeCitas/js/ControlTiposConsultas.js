function ServiciosCarga(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/TiposConsultas.php","",function(data){
      $("#TableConsultas").html(data);
    })

  }
  
  
  
  ServiciosCarga();