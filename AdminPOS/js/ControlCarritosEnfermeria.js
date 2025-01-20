function ServiciosCarga(){


    $.post("https://saludapos.com/AdminPOS/Consultas/CarritosEnfermeria.php","",function(data){
      $("#TableCarritos").html(data);
    })

  }
  
  
  
  ServiciosCarga();