<?php
$con = mysqli_connect('localhost', 'root', '', 'PRUEBA2');

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $insert = "INSERT INTO users(name, email) VALUES ('$name', '$email')";

    $return = mysqli_query($con, $insert);

    if ($return) {
        echo "El usuario se ha registrado con éxito.";
    } else {
        echo "Error al insertar: " . mysqli_error($con);
    }
}
mysqli_close($con);
?>
