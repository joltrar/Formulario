<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $bodega = $_POST['bodega'] ?? '';
    $sucursal = $_POST['sucursal'] ?? '';
    $moneda = $_POST['moneda'] ?? '';    
    $precio = $_POST['precio'] ?? '';
	$materiales = isset($_POST['materiales']) ? implode(', ', $_POST['materiales']) : '';
    $descripcion = $_POST['descripcion'] ?? '';    
           
	$servername = "localhost";
	$username   = "root";
	$password   = "";
	$dbname     = "empresa";

	// Crea conexion
	$conn = new mysqli($servername, $username, $password, $dbname);

	// valida conexión
	if ($conn->connect_error) {
		die("Error en la conexion: " . $conn->connect_error);
	}

	$sql = "SELECT id, codigo, nombre, id_bodega, id_sucursal, id_moneda, precio, materiales, descripcion FROM productos";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		
		while ($row = $result->fetch_assoc()) {
		    $codigo_bd = $row["codigo"];
			if($codigo==$codigo_bd) {
				// ya existe en la base de datos
				//echo "El codigo del producto ya esta registrado.";
				return;
				}
			}
	    }

	$sql = "SELECT * FROM productos";
		// Crea conexion
		$conn = new mysqli($servername, $username, $password, $dbname);
		// valida conexión
		if ($conn->connect_error) {
			die("Error en la conexion: " . $conn->connect_error);
		}

		$sql = "INSERT INTO `productos` ( `codigo`, `nombre`, `id_bodega`, `id_sucursal`, `id_moneda`, `precio`, `materiales`, `descripcion`)  
				VALUES ( '$codigo', '$nombre', '$bodega', '$sucursal', '$moneda', '$precio', '$materiales', '$descripcion')";
		$result = $conn->query($sql);

		if ($result === TRUE) {
			echo "Producto ingresado exitosamente.";
		} else {
			echo "Ha ocurrido un error en el ingreso.";
		}
	
	}
    
?>
