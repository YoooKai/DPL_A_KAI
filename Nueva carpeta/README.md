# Instalación y COnfiguración de VSFTPD

1- Limpiamos todo lo que podamos haber hecho anteriormente, en caso de haber intentado hacer esto anteriormente y comenzamos desde cero.

<img src="img/1.png">

2- Instalamos el paquete vsftpd:

<img src="img/2.png">

3- COmprobamos el estado del servidor:

<img src="img/3.png">

4- Buscamos la ip inet:

<img src="img/4.png">

5- Ahora, tenemos que entrar al archivo de configuración y escribir lo siguiente, utilizando la ip que sacamos anteriormente para que el servidor sepa a que ip tiene que atender. En este caso como el cliente tiene la misma que el servidor al ser una máquina virtual, escribo el mismo.
Para acceder al archivo escribimos:

`sudo nano /etc/netplan/00-installer-config.yaml`

<img src="img/2024-11-21_18-11.png">

6- Aplicamos los cambios con `sudo netplan apply`
NOs da unos avisos pero realiza los cambios.

<img src="img/2024-11-21_18-18.png">

## COnfiguración

Es importante poner la red en red interna en el servidor y en el cliente antes de realizar estos pasos.

Lo primero que hacemos es cambiar el NO por el YES para permitir a los usuarios anónimos conectarse.

<img src="img/paso11.png">

También es importante escribir 
`anon_root=/srv/ftp/anonimo`

<img src="img/paso2.png">

Y ahora con la IP y el usuario anonymous deberíamos poder conectarnos en filezilla.

7- Ahora tenemos que modificar de nuevo la configuración.

<img src="img/imp.png">

Nos conectamos con nuestro usuario administrador en filezilla:

<img src="img/2024-11-21_18-26.png">

Vemos que podemos entrar y mover y los archivos. Por ejemplo, movemos el archivo administrador.txt

<img src="img/2024-11-21_18-27.png">

<img src="img/2024-11-21_18-28.png">

## Usuarios
Creamos un usuario, por ejemplo llamado mika, el nombre de uno de mis perros, con `adduser mika`

<img src="img/2024-11-21_18-30.png">

Vemos que el usuario se ha creado correctamente con el comando:

`cat /etc/passwd`

<img src="img/22.png">

Modificamos el archivo de configuración de nuevo:

<img src="img/33.png">

<img src="img/44.png">

Tenemod que crear este fichero porque no lo crea automáticamente, para guardar a los usuarios.

<img src="img/55.png">

Añadimos el nombre de los usuarios que queramos que tengan permiso para moverse libremente en el servidor, como el administrador.

<img src="img/66.png">

Hacemos un restart para guardar los cambios y comprobamos el estatus del servidor:

<img src="img/77.png">

<img src="img/88.png">