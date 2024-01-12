function  SolicitudesTraspasos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/SolicitudesTraspasos.php","",function(data){
      $("#TableSolicitudes").html(data);
    })

  }
  
  
  
  SolicitudesTraspasos();