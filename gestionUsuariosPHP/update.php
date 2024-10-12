<?php
$con = mysqli_connect('localhost', 'root', '', 'PRUEBA2');

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";

    $return = mysqli_query($con, $update);

    if ($return) {
        echo "El usuario se ha actualizado correctamente.";
    } else {
        echo "Error al actualizar: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
