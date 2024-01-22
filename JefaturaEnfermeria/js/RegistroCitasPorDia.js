function CargaSignosVitales(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/RegistroPorDias.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitales();

  
