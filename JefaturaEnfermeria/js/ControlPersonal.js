function CargaPersonalEnfermeria(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/PersonalEnfermeria.php","",function(data){
      $("#PersonalEnfermeria").html(data);
    })
  
  }
  
  
  
  CargaPersonalEnfermeria();

  
