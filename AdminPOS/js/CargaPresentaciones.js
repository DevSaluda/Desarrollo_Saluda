function CargaPresentaciones(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Presentaciones.php","",function(data){
      $("#TablePresentaciones").html(data);
    })
  
  }
  
  
  
  CargaPresentaciones();

  
  