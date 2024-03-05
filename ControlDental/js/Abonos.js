function CargaAbonos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/Abonos.php","",function(data){
      $("#tablaAbonos").html(data);
    })

  }
  
  
  
  CargaAbonos();