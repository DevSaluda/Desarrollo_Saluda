function  CargaEspecialidadesExpress(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/EspecialidadesExpress.php","",function(data){
      $("#EspecialidadesExpress").html(data);
    })
  
  }
  
  CargaEspecialidadesExpress();

  
