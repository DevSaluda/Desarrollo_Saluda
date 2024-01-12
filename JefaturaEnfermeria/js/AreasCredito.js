function AreasCreditos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/AreasCreditos.php","",function(data){
      $("#TableAreasCreditos").html(data);
    })

  }
  
  
  
  AreasCreditos();