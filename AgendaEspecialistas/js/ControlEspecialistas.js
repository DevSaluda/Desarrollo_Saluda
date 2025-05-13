function CargaEspecialistas(){


    $.get("https://controlfarmacia.com/ControldecitasV2/Consultas/Especialistas.php","",function(data){
      $("#TablaEspecialistas").html(data);
    })
  
  }
  
  
  
  CargaEspecialistas();

  
