function CargaDataCampana(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/CampanasHorarios.php","",function(data){
      $("#TablaCampanasHorarios").html(data);
    })
  
  }
  
  
  
  CargaDataCampana();

  
