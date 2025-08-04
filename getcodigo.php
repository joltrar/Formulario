<?php
$conn = mysqli_connect("localhost","root","","empresa");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];

$out="false";
$sucursal = 0;

	$sql = "SELECT id, codigo, nombre, id_bodega, id_sucursal, id_moneda, precio, materiales, descripcion FROM productos";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		
		while ($row = $result->fetch_assoc()) {
		    $codigo_bd = $row["codigo"];
			if ($id==$codigo_bd) {
				// ya existe en la base de datos
				$out = "true";
				echo $out;
				return;
				}
			}
	    }
	

echo $out;

?>
