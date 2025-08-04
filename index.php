<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Formulario </title>
	
	<link rel="stylesheet" href="style.css" />
</head>
<body>
   
<?php
	include 'config.php';
?>

<script>
    function buscarcodigo(id) {
    let dataString = `id=${id}`;
    let url = "getcodigo.php";

    fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: dataString
            })
            .then(response => response.text()) // Obtener la respuesta en formato de texto
            .then(data => {

               if (data == "true") {
	               alert("El código del producto ya está registrado.");
	       }
               return;
            })
            .catch(error => console.error('Error:', error));
     }
</script>

<script>
    function buscarsucursal(id) {
    let dataString = `id=${id}`;
    let url = "getsucursal.php";

    fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: dataString
            })
            .then(response => response.text()) // Obtener la respuesta en formato de texto
            .then(data => {
               document.querySelector('#sucursal').innerHTML = data;
                
               return;
            })
            .catch(error => console.error('Error:', error));
     }
</script>

<center>
<div class="box">

<center><strong><h1>Formulario de Producto</h1></strong>
<p>
<p>

<form id="formulario">

<table>
<tr><td width="400px">C&oacute;digo</td><td width="50">  </td><td width="400px">Nombre</td></tr>
<tr><td width="400px"><input type="text" id="codigo" name="codigo" value="" style="width:95%"></td><td width="50"></td>
<td width="400px"><input type="text" id="nombre" name="nombre" value="" style="width:95%"></td></tr>

<tr><td width="400px">Bodega</td><td width="50">  </td><td width="400px">Sucursal</td></tr>

<tr>

<td width="400px">
<?php
    // Consulta todos las bodegas existentes en la base de datos
    $sql = "SELECT * FROM bodega";
    $result = $conn->query($sql);
?>

<select id="bodega" name="bodega" class="form-select" onchange="buscarsucursal(this.value)" style="width:97%">
<option value=""></option>
<?php
    $id = "";
    $nombre = "";
    if ($result->num_rows > 0) {
        // Muestra las bodegas en un combo box
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            echo '<option value="';
            echo $id;
            echo '"';
            echo '">';
            echo $nombre;
            echo '</option>';
        }
    }
?>
</td>

<td> </td>
<td width="400px">
<select id="sucursal" name="sucursal" class="form-select" style="width:97%">
    <option value=""></option>
</select>

</td>
</tr>

<tr><td width="400px">Moneda</td><td width="50">  </td><td width="400px">Precio</td></tr>

<tr>

<td width="400px">
<?php
    // Consulta todos las bodegas existentes en la base de datos
    $sql = "SELECT * FROM moneda";
    $result = $conn->query($sql);
?>

<select id="moneda" name="moneda"  style="width:97%">
<option value=""></option>
<?php
    $id = "";
    $nombre = "";
    if ($result->num_rows > 0) {
        // Muestra las bodegas en un combo box
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $nombre = $row["nombre"];
            echo '<option value="';
            echo $id;
            echo '"';
            echo '">';
            echo $nombre;
            echo '</option>';
        }
    }
?>
</td>


<td width="50"> </td>
<td width="400px">
<input type="text" id="precio" name="precio" value="" style="width:95%">
</td>
</tr>

</table>
</center>

<br>
<p align="left">Material del Producto
<br>
<input type="checkbox" name="materiales[]" value="Plastico">Pl&aacute;stico 
<input type="checkbox" name="materiales[]" value="Metal"> Metal 
<input type="checkbox" name="materiales[]" value="Madera"> Madera 
<input type="checkbox" name="materiales[]" value="Vidrio"> Vidrio 
<input type="checkbox" name="materiales[]" value="Textil"> Textil
<br>
<p>

  <p align="left">Descripci&oacute;n:</p>
  <textarea id="descripcion" name="descripcion" rows="4" cols="50" placeholder="Escribe tu descripci&oacute;n..." style="width: 575px; height: 58px;"></textarea><br><br>
  <input type="submit" value="Guardar Producto" class="button">

</form>

</div>
</center>

<div id="respuesta" style="margin-top:20px;color:green;"></div>

<script>
	document.getElementById('formulario').addEventListener('submit', function(event) {
	event.preventDefault();
	const form = event.target;

	const nombre = document.getElementById("nombre").value.trim();
	const codigo = document.getElementById("codigo").value.trim();
	const precio = document.getElementById("precio").value.trim();
	const bodega = document.getElementById("bodega").value.trim();
	const sucursal = document.getElementById("sucursal").value.trim();
	const moneda = document.getElementById("moneda").value.trim();
	const materiales = document.querySelectorAll('input[name="materiales[]"]:checked');
	const seleccionados = materiales.length;
	const descripcion = document.getElementById("descripcion").value.trim();

	if (codigo === "") {
		alert("El código del producto no puede estar en blanco.");
		return;
	}
	
	if ((codigo.length < 5) || (codigo.length > 15)) {
			alert("El código del producto debe tener entre 5 y 15 caracteres.");
			return;
	}	
		
	const regex = /^[A-Za-z0-9]+$/;
	const esValido = regex.test(codigo);
	
	if (!esValido) {
		alert("El código del producto debe contener letras y números");
		return;
	}
	
	const regex2 = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;
	const esValido2 = regex2.test(codigo);

	if (!esValido2) {
		alert("El código del producto debe contener letras y números");
		return;
	}	
	
	buscarcodigo(codigo);
	
	if (nombre === "") {
		alert("El nombre del producto no puede estar en blanco.");
		return;
	}

	if ((codigo.length < 2) || (codigo.length > 50)) {
			alert("El nombre del producto debe tener entre 2 y 50 caracteres.");
			return;
	}	

	if (bodega === "") {
		alert("Debe seleccionar una bodega.");
		return;
	}

	if (sucursal === "") {
		alert("Debe seleccionar una sucursal para la bodega seleccionada.");
		return;
	}
    
	if (moneda === "") {
		alert("Debe seleccionar una moneda para el producto.");
		return;
	}
	
	if (precio === "") {
		alert("El precio del producto no puede estar en blanco.");
		return;
	}
	
	const regex3 = /^(?:0|[1-9]\d*)(?:\.\d{1,2})?$/;
	const esValido3 = regex3.test(precio);

	if (!esValido3) {
		alert("El precio del producto debe ser un número positivo con hasta dos decimales.");
		return;
	}

	if (seleccionados < 2) {
		alert("Debe seleccionar al menos dos materiales para el producto.");
		return;
	}       

	if (descripcion === "") {
		alert("La descripción del producto no puede estar en blanco.");
		return;
	}  
	
	if ((descripcion.length < 10) || (descripcion.length > 1000)) {
		alert("La descripción del producto debe tener entre 10 y 1000 caracteres.");
		return;
	}		

	// Envío por AJAX
	const datos = new FormData(this);
	const xhr = new XMLHttpRequest();
	xhr.open("POST", "procesar.php", true);
	xhr.onload = function () {
	document.getElementById("respuesta").innerText = xhr.responseText;
	};
	xhr.send(datos);
	});

	
</script>

</body>
</html>
