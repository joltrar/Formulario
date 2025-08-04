<?php
$conn = mysqli_connect("localhost","root","","empresa");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$sql = "SELECT * FROM sucursal WHERE id_bodega= $id";
$result = mysqli_query($conn,$sql);

$out='';
$sucursal = 0;

if ($result->num_rows > 0) {

    $out .=  "$<option value=''></option>";

    while($row = mysqli_fetch_assoc($result)){
        {
            $nombre = $row["nombre"];
            $sucursal = $row["id"];
            $out .=  "$<option value='$sucursal'>$nombre</option>";
        }
    }
    echo $out;

}
?>
