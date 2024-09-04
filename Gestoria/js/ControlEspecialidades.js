function CargaEspecialidades(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/Especialidades.php","",function(data){
      $("#tabla").html(data);
    })
  
  }
  
  
  
  CargaEspecialidades();

  
