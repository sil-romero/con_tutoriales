<?php 

include("db.php"); // me trae la conexion

if (isset($_POST['guardar_tarea'])) {
    $titulo = $_POST['titulo']; // lo que recibas por el metodo post guardame en la variable titulo
    $descripcion = $_POST['descripcion'];

    $query = "INSERT INTO tareas(TITULO, DESCRIPCION) VALUES ('$titulo', '$descripcion')";
    $resultado = mysqli_query($conn, $query);
    if (!$resultado) {
        die("fállo en la conexión");
    }

    $_SESSION['mensaje'] = 'TAREA GUARDADA';
    $_SESSION['tipo_mensaje'] = 'success';

    header("location: index.php");

}



?>