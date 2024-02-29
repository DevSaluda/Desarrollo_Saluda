function CargaEspecialistasH(){


  $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/EspecialistasH.php","",function(data){
    $("#TablaEspecialistas").html(data);
  })

}



CargaEspecialistasH();


