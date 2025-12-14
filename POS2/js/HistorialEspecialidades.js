function CargaEspecialidadesH(){


  $.get("https://saludapos.com/Controldecitas/Consultas/EspecialidadesH.php","",function(data){
    $("#tabla").html(data);
  })

}



CargaEspecialidadesH();


