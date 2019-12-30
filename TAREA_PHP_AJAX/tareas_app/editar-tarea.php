<?php
include('database.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$query = "UPDATE tareas SET nombre = '$nombre', descripcion = '$descripcion' WHERE id_tarea = '$id'";

$resultado = mysqli_query($connection, $query);

if (!$resultado) {
    die('Consulta Fallida.');
}

echo "Tarea actualizada";


?>