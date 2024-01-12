function   CargaPmedicos(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/PersonalMedico.php","",function(data){
      $("#PersonalMedico").html(data);
    })
  
  }
  
  
  CargaPmedicos();

  

  
