<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Registrar pedido</title>
	</head>
	<body>
		Registrar pedido con caca!
		<div id="divForm">
			<form method="post" action="solicitarPedido.php" enctype="multipart/form-data">
				<div id="divDatosPedido">
					<fieldset>
						<legend>Datos del almacen</legend>
						<div id="divCamposPedido">
							<label id="label_almacen" for="idAlmacen">Identificador del almacén:</label>
							<input id="idAlmacen" name="idAlmacen" type="text" maxlength="8"/>
						</div>
					</fieldset>
					<fieldset>
						<legend>Lista de artículos</legend>
						<div id="divArticulosPedido" class="divProductos">
							<div id="producto0" class="lineaProducto">
								<label id="label_idProducto0" for="idProducto0">Producto:</label>
								<input id="idProducto0" name="idProducto0" type="text" maxlength="8"/>
								<label id="label_cantProducto0" for="cantProducto0">Cantidad:</label>
								<input id="cantProducto0" name="cantProducto0" type="text" maxlength="3"/>
								<input id="botEliminar0" name="botEliminar0" type="button" onclick="eliminarProducto(this)" value="Eliminar de la lista"/>
							</div>
						</div>
						<div id="divAnadirProducto">
							<input id="botAnadir" name="botAnadir" type="button" onclick="anadirProducto()" value="Añadir más"/>
						</div>
					</fieldset>
				</div>
				<div id="divSubmit">
				  <button id="submit" type="submit">Enviar</button>
				</div>
			</form>
		</div>
		<script type="text/javascript" src="/js/comun.js"></script>
	</body>
</html>