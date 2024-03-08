function CargaSignosVitales(){


    $.get("https://saludapos.com/AdminPOS/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
