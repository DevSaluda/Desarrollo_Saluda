function  SolicitudesTraspasos(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/SolicitudesTraspasos.php","",function(data){
      $("#TableSolicitudes").html(data);
    })

  }
  
  
  
  SolicitudesTraspasos();