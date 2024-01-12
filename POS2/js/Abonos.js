function CargaAbonos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/Abonos.php","",function(data){
      $("#tablaAbonos").html(data);
    })

  }
  
  
  
  CargaAbonos();