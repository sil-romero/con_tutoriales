<?php

session_start();


// utilizamos una biblioteca de msql. a esta funcion le damos los parametros de nuestra base de datos
$conn = mysqli_connect(
    'localhost', // ip o dominio donde esta la base de datos 
    'root', // el usuario 
    '', // la contraseña
    'fz_php_crud' // la base de datos que usaremos 
); // esto me devuelve un objeto de conexión, lo guardamos un una variable $conn

/*  para verificar si se conecto con la base de datos
if (isset($conn)) {
    echo "DB conectada exitosamente";
} */



?>