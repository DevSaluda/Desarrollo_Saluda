function CargaSignosVitalesLibre(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/RegistroLibre.php","",function(data){
      $("#sv").html(data);
    })
  
  }
  
  
  CargaSignosVitalesLibre();

  
