function Estado()
{

 
/* Para obtener el texto */
var combo = document.getElementById("estado2");
var selected = combo.options[combo.selectedIndex].text;
$("#estador").val(selected);
}

