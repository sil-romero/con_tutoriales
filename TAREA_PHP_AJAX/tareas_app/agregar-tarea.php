<?php
include('database.php');

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $query = "INSERT into tareas(nombre, descripcion) VALUES ('$nombre','$descripcion')";
    $resultado = mysqli_query($connection, $query);

    if (!$resultado) {
        die('La consulta ha fallado');
    }
    echo 'Tarea agregada';
}

?>