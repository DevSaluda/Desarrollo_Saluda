function  CargaEspecialidadesExpress(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/EspecialidadesExpress.php","",function(data){
      $("#EspecialidadesExpress").html(data);
    })
  
  }
  
  CargaEspecialidadesExpress();

  
