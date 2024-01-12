function CargaTotalSignos(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/TotalSignosVitalesGenerales.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
   
  
  CargaTotalSignos();

  
