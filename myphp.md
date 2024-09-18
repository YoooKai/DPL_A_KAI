# Seguridad

1. Abrir XAMPP

<img src="./img/11.png">

2. Encender:

<img src="img/open.png" height="250px">

Le damos a Start All.

<img src="img/start.png" height="250px">

3. Abrir localhost en el navegador.

<img src="img/myphp.png" height="250px">

4. Ir a sq, privilegios, cambiar contraseña
NO deja, porque se debe editar primero el fichero de configuración


<img src="img/2a.png" height="250px">

<img src="img/2sqlPrivilegios.png">

<img src="img/2changepasswd.png" height="250px">

5. Para eso, abrir la carpeta de XAMPP y localizar el config.

<img src="img/openfolder.png" height="250px">

<img src="img/configfile.png">


6. Buscar la línea de contraseña, y escribir entre las comillas una contraseña. Luego guardamos los cambios del archivo.
Ya tenemos una contraseña para esa cuenta.

<img src="img/1.png">

<img src="img/2.png">


7. Creamos ahora otra cuenta. Para ello vamos a cuentas de usuario, y luego a agregar cuenta de usuario.

<img src="img/agragarusuario.png">

Ponemos un nombre de usuario y una contraseña. Al Nombre de Host seleccionamos la opción  "Local".

<img src="img/agregarusuario2.png" height="250px">

En la base de datos para la cuenta de usuario, damos click solo a la primera opción.

EN los privilegios globales, seleccionamos Datos y Estructura, y no Administración ya que no queremos darle a este permisos de administrador.

<img src="img/crearusuar3.png" height="250px">

8. Ahora, queremos que nos aparezca la ventana que nos pregunte por el usuario y la contraseña al entrar a localhost.

Para ello, de nuevo abrimos el mismo fichero de configuración.
Y donde pone config en la sección de Authentification Type, cambiamos "config" por "http".

<img src="img/3.png">

Ahora, ya podemos entrar como root o como el otro usuario.


<img src="img/2adsa.png" height="250px">



