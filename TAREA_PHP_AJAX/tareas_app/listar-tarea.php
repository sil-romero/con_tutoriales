<?php
// con este archivo obtenemos todas la tareas para mostrarlo en pantella en forma de tabla.
// el archivo consultara a la base de datos todas las tareas y las enviara al navegador para que las pinte por pantalla. 

include('database.php');
// con la variable $query asignamos la consulta a la database.
$query = "SELECT * from tareas";
//a travez de mysqli_query ejecutamos la consulta, tiene como parametro la coneccion y la consulta. eso lo guardamos en la variable resultado
$resultado = mysqli_query($connection, $query);
// pasamos a comprobar el resultado
if (!$resultado) {
    die('consulta fallida'.mysqli_error($connection));
}
// vamos a convertir en un json todo lo que recivamos de la database.
// creamos la variable json y lo convertimos en un array.
$json = array();
while ($row = mysqli_fetch_array($resultado)) {
    $json[] = array(
        'nombre' =>  $row['nombre'],
        'descripcion' => $row['descripcion'],
        'id' => $row['id_tarea']
    );
}

//cada objeto es una tarea de la database. la funcion json_esncode retorna los datos codificados.
$jsonstring = json_encode($json);
echo $jsonstring;
// hasta aqui, apenas la aplicacion inicie ya le responde todas las tareas que tiene guardada la base de datos.



?>