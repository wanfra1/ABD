/**
 * Funciones usadas en la aplicación Gestión de stockaje
 */
function anadirProducto(productos) {
	var numProductos = document.getElementsByClassName("divProductos")[0].children.length;
	var nuevoIndice = parseInt(document.getElementsByClassName("divProductos")[0].children[numProductos - 1].id
			.substring(8)) + 1;

	document.getElementsByClassName("divProductos")[0].innerHTML = document
			.getElementsByClassName("divProductos")[0].innerHTML
			+ "<div id='producto" + nuevoIndice
			+ "'><label id='label_idProducto"
			+ nuevoIndice
			+ "' for='idProducto"
			+ nuevoIndice
			+ "'>Producto:</label><select id='idProducto"
			+ nuevoIndice
			+ "' name='idProducto"
			+ nuevoIndice
			+ "'>"
			+ opcionesProducto(productos)
			+ "</select>"
			+ "<label id='label_cantProducto"
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

/**
 * Carga las opciones a partir de la lista de productos.
 * @param productos Lista de productos
 * @returns {string}
 */
function opcionesProducto(productos) {
	var opciones = '';
	for (i = 0; i < productos.length; i++) {
		opciones+= '<option value="' + productos[i].id + '">' + productos[i].nombre + ' </option>';
	}
	return opciones;
}

function eliminarProducto(objeto) {
	var numProductos = document.getElementsByClassName("divProductos")[0].children.length;
	if (numProductos > 1) {		
		objeto.parentElement.remove();
	} else {
		alert("Tienes que introducir al menos un producto");
	}
}