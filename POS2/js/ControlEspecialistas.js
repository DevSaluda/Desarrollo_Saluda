function CargaEspecialistas(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/Especialistas.php","",function(data){
      $("#TablaEspecialistas").html(data);
    })
  
  }
  
  
  
  CargaEspecialistas();

  
