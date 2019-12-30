<?php
include('database.php');

$busqueda = $_POST['busqueda'];

if(!empty($busqueda)) {
    $query = "SELECT * FROM tareas WHERE nombre LIKE '$busqueda%'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Error de consulta'.mysqli_error($connection));
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
       $json[] = array(
           'nombre' => $row['nombre'],
           'descripcion' => $row['descripcion'],
           'id-tarea' => $row['id_tarea']
       ); 
    }

    // el json_encode devuelve el dato en formato de string.
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

?>