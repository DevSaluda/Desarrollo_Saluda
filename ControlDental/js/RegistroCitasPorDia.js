function CargaSignosVitales(){


    $.get("https://saludapos.com/ControlDental/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
