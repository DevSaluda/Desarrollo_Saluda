function EspecialidadesG(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/EspecialidadesG.php","",function(data){
      $("#EspecialidadesG").html(data);
    })
  
  }
  
  
  
  EspecialidadesG();

  
