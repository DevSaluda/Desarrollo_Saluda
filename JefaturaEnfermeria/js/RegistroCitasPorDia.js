function CargaSignosVitales(){


    $.get("https://saludapos.com/CEnfermeria/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
