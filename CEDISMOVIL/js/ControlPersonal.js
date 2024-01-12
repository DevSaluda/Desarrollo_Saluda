function CargaDataPersonal(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/DatosPersonal.php","",function(data){
      $("#DatosPersonal").html(data);
    })
  
  }
  
  
  
  CargaDataPersonal();

  
  
  
