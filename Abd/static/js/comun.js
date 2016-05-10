/**
 * Funciones usadas en la aplicación Gestión de stockaje
 */
function anadirProducto(productos) {
	var numProductos = document.getElementsByClassName("divProductos")[0].children.length;
	var nuevoIndice = parseInt(numProductos);
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
			+ "' type='button' class='button' onclick='eliminarProducto(this)' value='Eliminar de la lista'/><span id='errorCant" + nuevoIndice + "'></span></div>";
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

function validarVenta() {
	var descripcion = document.forms["venta"]["descripcion"].value;
	var exito = true;
	if (descripcion == null || descripcion == "") {
		document.getElementById('erroresDescripcion').innerHTML = 'Debe rellenar la descripción';
		exito = false;
	} else {
		document.getElementById('erroresDescripcion').innerHTML = '';
	}
	var almacen = document.forms["venta"]["almacen"].value;
	if (almacen == null || almacen == "") {
		document.getElementById('erroresAlmacen').innerHTML = 'Debe rellenar el almacén';
		exito = false;
	} else {
		document.getElementById('erroresAlmacen').innerHTML = '';
	}
	var numProductos = parseInt(document.getElementsByClassName("divProductos")[0].children.length) - 1;
	var i = 1;
	var sonNumericos = true;
	if (numProductos == 0) {
		document.getElementById('errorProductoVacio').innerHTML = 'Debe introducir al menos un producto';
	} else {
		document.getElementById('errorProductoVacio').innerHTML = '';
	}
	while (i <= numProductos && sonNumericos) {
		var cantidad = document.forms["venta"]["cantProducto" + i].value;
		if (cantidad == null || cantidad == undefined  || cantidad == "") {
			document.getElementById('errorCant' + i).innerHTML = 'Debe introducir una cantidad';
			sonNumericos = false;
			exito = false;
		} else if (isNaN(cantidad)) {
			document.getElementById('errorCant' + i).innerHTML = 'Debe ser numerico';
			sonNumericos = false;
			exito = false;
		} else {
			document.getElementById('errorCant' + i).innerHTML = '';
		}
		i++;
	}
	return exito;
}

function validarPedido() {
	var descripcion = document.forms["pedido"]["proveedor"].value;
	var exito = true;
	if (descripcion == null || descripcion == "") {
		document.getElementById('erroresProveedor').innerHTML = 'Debe rellenar el proveedor';
		exito = false;
	} else {
		document.getElementById('erroresProveedor').innerHTML = '';
	}
	var almacen = document.forms["pedido"]["almacen"].value;
	if (almacen == null || almacen == "") {
		document.getElementById('erroresAlmacen').innerHTML = 'Debe rellenar el almacén';
		exito = false;
	} else {
		document.getElementById('erroresAlmacen').innerHTML = '';
	}
	var numProductos = parseInt(document.getElementsByClassName("divProductos")[0].children.length) - 1;
	var i = 1;
	var sonNumericos = true;
	if (numProductos == 0) {
		document.getElementById('errorProductoVacio').innerHTML = 'Debe introducir al menos un producto';
	} else {
		document.getElementById('errorProductoVacio').innerHTML = '';
	}
	while (i <= numProductos && sonNumericos) {
		var cantidad = document.forms["pedido"]["cantProducto" + i].value;
		if (cantidad == null || cantidad == undefined  || cantidad == "") {
			document.getElementById('errorCant' + i).innerHTML = 'Debe introducir una cantidad';
			sonNumericos = false;
			exito = false;
		} else if (isNaN(cantidad)) {
			document.getElementById('errorCant' + i).innerHTML = 'Debe ser numerico';
			sonNumericos = false;
			exito = false;
		} else {
			document.getElementById('errorCant' + i).innerHTML = '';
		}
		i++;
	}
	return exito;
}