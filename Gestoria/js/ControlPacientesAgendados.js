function CargaPacientesAgenda(){


    $.post("https://controlfarmacia.com/POS2/Consultas/AgendaPacientesCompletos.php","",function(data){
      $("#Pacientes").html(data);
    })
  
  }
  
  
  
  CargaPacientesAgenda();

  
