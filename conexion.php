<?php
echo "<pre>";

$con = mysqli_connect('localhost', 'root', '', 'PRUEBITA');

//Inserción de datos a la tabla con sintaxis sql.
$insert = "insert into users(name,email) values ('ana', 'analopez@gmail.com')";

//le pasamos la conexión y la consulta que queremos ejecutar
$return = mysqli_query($con, $insert);
//esto devuelve un valor, True si no hay error
print_r(($return) );

//cerrar la conexión, para no gastar memoria y evitar problemas de rendimiento
mysqli_close($con);

