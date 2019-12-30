<?php
include('database.php');

$id = $_POST['id'];
$query = "SELECT * FROM tareas WHERE id_tarea = $id";

$resultado = mysqli_query($connection, $query);

if (!$resultado) {
    die('Consulta Fallida');
}

$json = array();
while($row = mysqli_fetch_array($resultado)) {
    $json[] = array(
        'nombre' => $row['nombre'],
        'descripcion' => $row['descripcion'],
        'id' => $row['id_tarea']
    );
}
 
$jsonstring = json_encode($json[0]);
echo $jsonstring;

?>