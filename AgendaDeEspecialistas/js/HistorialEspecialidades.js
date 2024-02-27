function CargaEspecialidadesH(){


  $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/EspecialidadesH.php","",function(data){
    $("#EspecialidadesVen").html(data);
  })

}



CargaEspecialidadesH();


