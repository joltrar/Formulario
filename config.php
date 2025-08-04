<?php
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
?>
