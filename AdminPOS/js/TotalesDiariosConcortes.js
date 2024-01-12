function  TotalDiarioCorte(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TotalDiarioCorte.php","",function(data){
      $("#TotalesDiariosCon").html(data);
    })

  }
  
  
  
  TotalDiarioCorte();