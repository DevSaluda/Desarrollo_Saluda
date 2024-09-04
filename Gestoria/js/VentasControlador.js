function add(button) {
	var row = button.parentNode.parentNode;
  var cells = row.querySelectorAll('td:not(:last-of-type)');
  addToCartTable(cells);
}

function remove() {
	var row = this.parentNode.parentNode;
  document.querySelector('#target tbody')
  				.removeChild(row);
}

function addToCartTable(cells) {
   var code = cells[0].innerText;
   var name = cells[1].innerText;
 
   var lote = cells[2].innerText;
   var price = cells[3].innerText;
   
   var newRow = document.createElement('tr');
   newRow.setAttribute('data-price', price.substring(1));
   
   newRow.appendChild(createCell(code));
   newRow.appendChild(createCell(name));
    newRow.appendChild(createCell(lote));
   newRow.appendChild(createCell(price));
  
   var cellInputQty = createCell();
   cellInputQty.appendChild(createInputQty());
   newRow.appendChild(cellInputQty);
   var cellRemoveBtn = createCell();
   cellRemoveBtn.appendChild(createRemoveBtn())
   newRow.appendChild(cellRemoveBtn);
   
   document.querySelector('#target tbody').appendChild(newRow);
}

function createInputQty() {
	var inputQty = document.createElement('input');
  inputQty.type = 'number';
  inputQty.required = 'true';
  inputQty.className = 'form-control'
  inputQty.min = 1; // mínimo un producto
  inputQty.onchange = onQtyChange;
  return inputQty;
}

function createRemoveBtn() {
	var btnRemove = document.createElement('button');
  btnRemove.className = 'btn btn-xs btn-danger';
  btnRemove.onclick = remove;
  btnRemove.innerText = 'Descartar';
  return btnRemove;
}

function createCell(text) {
	var td = document.createElement('td');
  if(text) {
  	td.innerText = text;
  }
  return td;
}

function onQtyChange(e) {
  var row = this.parentNode.parentNode;
	var cellPrice = row.querySelector('td:nth-child(3)');
  var prevPrice = Number(row.getAttribute('data-price'));
  var newQty = Number(this.value);
  var total = prevPrice * newQty;
  cellPrice.innerText = '$' + total;
}