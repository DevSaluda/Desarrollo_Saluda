function CargaPresentaciones(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/Presentaciones.php","",function(data){
      $("#TablePresentaciones").html(data);
    })
  
  }
  
  
  
  CargaPresentaciones();

  
  