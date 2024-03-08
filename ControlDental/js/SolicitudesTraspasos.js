function  SolicitudesTraspasos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/SolicitudesTraspasos.php","",function(data){
      $("#TableSolicitudes").html(data);
    })

  }
  
  
  
  SolicitudesTraspasos();