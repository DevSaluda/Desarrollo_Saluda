function   CargaPmedicos(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/PersonalMedico.php","",function(data){
      $("#PersonalMedico").html(data);
    })
  
  }
  
  
  CargaPmedicos();

  

  
