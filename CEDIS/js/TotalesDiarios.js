function  TotalDiarioSinCorte(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TotalDiarioSinCorte.php","",function(data){
      $("#TotalesDiariosSin").html(data);
    })

  }
  
  
  
  TotalDiarioSinCorte();