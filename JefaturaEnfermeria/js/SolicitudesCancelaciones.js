function  SolicitudesCancelaciones(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/SolicitudesDecancelaciones.php","",function(data){
      $("#TableSolicitudesCancelaciones").html(data);
    })

  }
  
  
  
  SolicitudesCancelaciones();