<?php

include('database.php');
// agregamos una condicion de si existe el id.
if (isset($_POST['id'])) {
    // el fomnet nos manda por el metodo post y guardamos en una variable el valor
 $id = $_POST['id'];

 $query = "DELETE FROM tareas WHERE id_tarea = $id";
    // ejecutamos la consulta (consulta de eliminacion) y lo gurdamos en una variable.
 $resultado = mysqli_query($connection, $query); 
    // si la variable resultado esta vacia se tiene 
 if (!$resultado) {
    die('consulta fallida. ');
 }

 echo "Tarea Eliminada"; 

}




?>