function CargaTiposMobi(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TiposMobiliarios.php","",function(data){
      $("#tablaTiposmobiliarios").html(data);
    })

  }
  
  
  
  CargaTiposMobi();