function CargaChecadorGeneral(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/logsGeneral","",function(data){
      $("#ChecadorGeneral").html(data);
    })
  
  }
  
  
  CargaChecadorGeneral();

  
