function AreasCreditos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/AreasCreditos.php","",function(data){
      $("#TableAreasCreditos").html(data);
    })

  }
  
  
  
  AreasCreditos();