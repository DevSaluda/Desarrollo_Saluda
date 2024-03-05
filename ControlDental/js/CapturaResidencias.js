function Estado()
{

 
/* Para obtener el texto */
var combo = document.getElementById("estado");
var selected = combo.options[combo.selectedIndex].text;
$("#estador").val(selected);
}

