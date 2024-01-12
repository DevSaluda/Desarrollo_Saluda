function CargaEspecialistasH(){


  $.get("https://controlfarmacia.com/Controldecitas/Consultas/EspecialistasH.php","",function(data){
    $("#TablaEspecialistas").html(data);
  })

}



CargaEspecialistasH();


