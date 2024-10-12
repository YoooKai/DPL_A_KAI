<?php
$con = mysqli_connect('localhost', 'root', '', 'PRUEBA2');

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $delete = "DELETE FROM users WHERE id = $id";

    $return = mysqli_query($con, $delete);

    // Verificar si la actualización fue exitosa
    if ($return) {
        echo "El usuario ha sido borrado correctamente.";
    } else {
        echo "Error al borrar: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
