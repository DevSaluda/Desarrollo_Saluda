function  TotalGeneralCorte(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TotalGeneralCorte.php","",function(data){
      $("#TotalesGeneralesCon").html(data);
    })

  }
  
  
  
  TotalGeneralCorte();