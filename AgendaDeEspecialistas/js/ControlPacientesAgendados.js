function CargaPacientesAgenda(){


    $.post("https://controlfarmacia.com/ControldecitasV2/Consultas/AgendaPacientesCompletos.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  
  CargaPacientesAgenda();

  
