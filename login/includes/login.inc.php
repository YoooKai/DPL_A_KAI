<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form class="form-signin" method="post" action="actions/login.act.php">
                <h4 class="form-signin-heading text-center mb-4">Por favor, inicie sesión</h4>
                
                <div class="form-group">
                    <label for="email_login" class="sr-only">Email</label>
                    <input type="email" id="email_login" name="email_login" class="form-control mb-3" placeholder="Email" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password_login" class="sr-only">Contraseña</label>
                    <input type="password" id="password_login" name="password_login" class="form-control mb-3" placeholder="Contraseña" required>
                </div>
                
                <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Enviar</button>
                <a class="btn btn-lg btn-warning btn-block" href="access.php?page=new">Alta nuevo usuario</a>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
