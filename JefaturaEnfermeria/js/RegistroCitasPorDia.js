function CargaSignosVitales(){


    $.get("https://saludapos.com/JefaturaEnfermeria/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
