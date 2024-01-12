function CargaTotalSignos(){


    $.get("https://controlconsulta.com/CEnfermeria/Consultas/TotalSignosVitalesDias.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
   
  
  CargaTotalSignos();

  
