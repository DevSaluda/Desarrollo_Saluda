function CargaEntradas(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/Entradas.php","",function(data){
      $("#RegistrosEntradas").html(data);
    })
  
  }
  
  
  
  CargaEntradas();

  
  