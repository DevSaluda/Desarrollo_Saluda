$(document).ready(function(){
    $("#frm_filtrarproducto").submit(function(e){
        e.preventDefault();
        filtarPorProducto();
    });
});
function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  function filtarPorProducto(){
    var codigo_barras = $("#codigo_barras").val();
    alert("El codigo de busqueda es: "+codigo_barras);
    //$.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDia.php","",function(data){
    //  $("#TableVentasDelDia").html(data);
    //})
  }
  
  CargaVentasDelDia();