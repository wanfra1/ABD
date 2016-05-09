/**
 * Funciones usadas en la página SolicitarSuministro.html
 */
function anadirProducto() {
	var listaProductos = document.getElementById("divArticulosSuministro").children;
	var nuevoIndice = listaProductos.length;

	document.getElementById("divArticulosSuministro").innerHTML = document
			.getElementById("divArticulosSuministro").innerHTML
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
			+ "' type='text' maxlength='3'/></div>";
}