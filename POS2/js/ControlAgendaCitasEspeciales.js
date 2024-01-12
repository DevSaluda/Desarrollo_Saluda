function CargaCitasEspeciales(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/AgendaCitasEspecialistas.php","",function(data){
      $("#TablaAgendaCitas").html(data);
    })
  
  }
  
  CargaCitasEspeciales()

  
