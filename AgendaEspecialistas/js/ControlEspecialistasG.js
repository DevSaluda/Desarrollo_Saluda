function CargaEspecialistasG(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/EspecialistasG.php","",function(data){
      $("#TablaEspecialistas").html(data);
    })
  
  }
  
  
  
  CargaEspecialistasG();
  
  
  