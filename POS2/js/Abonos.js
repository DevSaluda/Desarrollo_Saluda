function CargaAbonos(){


    $.post("https://saludapos.com/POS2/Consultas/Abonos.php","",function(data){
      $("#tablaAbonos").html(data);
    })

  }
  
  
  
  CargaAbonos();