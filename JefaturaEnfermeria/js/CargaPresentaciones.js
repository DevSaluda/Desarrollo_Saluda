function CargaPresentaciones(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Presentaciones.php","",function(data){
      $("#TablePresentaciones").html(data);
    })
  
  }
  
  
  
  CargaPresentaciones();

  
  