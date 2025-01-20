function ServiciosCarga(){


    $.post("https://saludapos.com/AdminPOS/Consultas/CarritosEnfermeria.php","",function(data){
      $("#TableConsultas").html(data);
    })

  }
  
  
  
  ServiciosCarga();