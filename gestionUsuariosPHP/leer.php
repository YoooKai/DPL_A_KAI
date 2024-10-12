<?php
echo "<pre>";
$con = mysqli_connect('localhost', 'root', '', 'PRUEBA2');

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
$sql = "SELECT id, name, email, created_at FROM users";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Fecha de creación</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo "No se encontraron datos en la tabla 'users'.";
}

mysqli_close($con);
?>
