function  SolicitudesCancelaciones(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/SolicitudesDecancelaciones.php","",function(data){
      $("#TableSolicitudesCancelaciones").html(data);
    })

  }
  
  
  
  SolicitudesCancelaciones();