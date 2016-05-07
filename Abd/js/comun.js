/**
 * Funciones usadas en la aplicación Gestión de stockaje
 */
function anadirProducto() {
	var numProductos = document.getElementsByClassName("divProductos")[0].children.length;
	var nuevoIndice = parseInt(document.getElementsByClassName("divProductos")[0].children[numProductos - 1].id
			.substring(8)) + 1;

	document.getElementsByClassName("divProductos")[0].innerHTML = document
			.getElementsByClassName("divProductos")[0].innerHTML
			+ "<div id='producto"
			+ nuevoIndice
			+ "'><label id='label_idProducto"
			+ nuevoIndice
			+ "' for='idProducto"
			+ nuevoIndice
			+ "'>Producto:</label><input id='idProducto"
			+ nuevoIndice
			+ "' name='idProducto"
			+ nuevoIndice
			+ "' type='text' maxlength='8'/><label id='label_cantProducto"
			+ nuevoIndice
			+ "' for='cantProducto"
			+ nuevoIndice
			+ "'>Cantidad:</label><input id='cantProducto"
			+ nuevoIndice
			+ "' name='cantProducto"
			+ nuevoIndice
			+ "' type='text' maxlength='3'/><input id='botEliminar"
			+ nuevoIndice
			+ "' name='botEliminar"
			+ nuevoIndice
			+ "' type='button' onclick='eliminarProducto(this)' value='Eliminar de la lista'/></div>";
}

function eliminarProducto(objeto) {
	objeto.parentElement.remove();
}