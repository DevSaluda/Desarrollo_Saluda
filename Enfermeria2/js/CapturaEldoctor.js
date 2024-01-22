function ElDoctor()
{
 
/* Para obtener el texto */
var combo = document.getElementById("medico");
var selected = combo.options[combo.selectedIndex].text;
$("#doctor").val(selected);
}
