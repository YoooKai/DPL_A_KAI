<?php
echo "<pre>";

$con = mysqli_connect('localhost', 'root', '', 'PRUEBITA');

$update = "UPDATE users SET name = 'Carolina', email = 'carolina87r@gmail.com' WHERE id = 1";
$return = mysqli_query($con, $update);
print_r($return);
mysqli_close($con);