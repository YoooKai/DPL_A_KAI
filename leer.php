<?php
echo "<pre>";

$con = mysqli_connect('localhost', 'root', '', 'PRUEBITA');

$sql = "SELECT id, name, email, created FROM users";
$result = mysqli_query($con, $sql);
$rows = mysqli_fetch_array($result, MYSQLI_BOTH);
//print_r($rows);

do{
    $data[] = $rows;
}while ($rows = mysqli_fetch_array($result, MYSQLI_BOTH));

print_r($data);

mysqli_close($con);