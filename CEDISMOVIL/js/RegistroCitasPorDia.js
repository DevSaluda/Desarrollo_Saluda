function CargaSignosVitales(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
