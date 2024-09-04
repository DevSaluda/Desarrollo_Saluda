function CargaEspecialidadesH(){


  $.get("https://controlfarmacia.com/Controldecitas/Consultas/EspecialidadesH.php","",function(data){
    $("#tabla").html(data);
  })

}



CargaEspecialidadesH();


