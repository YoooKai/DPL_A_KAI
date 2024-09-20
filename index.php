<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--Abrir XAMPP: sudo /opt/lampp/manager-linux-x64.run-->
    
    <form method="post" action="get-post.php" enctype="multipart/form-data">
        Nombre: <input type="text" name="usuario">
        <br>
        Fichero: <input type="file" name="fichero">
        <input type="submit" name="enviar" value="enviar">
        <br>
        
    </form>
    

    
    
</body>
</html>