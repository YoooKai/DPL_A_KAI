<?php
echo "<pre>";

$con = mysqli_connect('localhost', 'root', '', 'PRUEBITA');

$delete = "DELETE FROM users WHERE id = 1";

$return = mysqli_query($con, $delete);
print_r($return);
mysqli_close($con);

