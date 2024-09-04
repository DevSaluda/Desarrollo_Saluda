function  SolicitudesTraspasos(){


    $.post("https://saludapos.com/POS2/Consultas/SolicitudesTraspasos.php","",function(data){
      $("#TableSolicitudes").html(data);
    })

  }
  
  
  
  SolicitudesTraspasos();