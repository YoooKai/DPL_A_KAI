
## Gestión de Usuarios

Crea un nuevo usuario con:

 `sudo adduser <nombre_usuario>`

<img src="img/2024-11-21_18-30.png">

Verifica que se ha creado correctamente con el comando:

`cat /etc/passwd`

<img src="img/22.png">

Edita el archivo de configuración otra vez:

`sudo nano /etc/vsftpd.conf`

Añade o modifica las siguientes líneas

`chroot_local_user=YES`

`chroot_list_enable=YES`

`chroot_list_file=/etc/vsftpd.chroot_list`

`allow_writeable_chroot=YES`


<img src="img/44.png">

Crea el archivo /etc/vsftpd.chroot_list y añade los nombres de los usuarios que podrán moverse fuera de su directorio raíz:

`sudo nano /etc/vsftpd.chroot_list`

<img src="img/55.png">

Añadimos el nombre de los usuarios que queramos que tengan permiso para moverse libremente en el servidor, como el administrador.

<img src="img/66.png">

Hacemos un reinicio para guardar los cambios y comprobamos el estatus del servidor:

`sudo service vsftpd restart`

`sudo service vsftpd status`

<img src="img/77.png">

Vemos que este usuario que no ha sido añadido a la lista, no puede moverse por el servidor, solo puede acceder a su carpeta personal.

<img src="img/88.png">

<img src="img/99.png">

Y, sin embargo, el usuario que sí ha sido añadido a la lista, puede moverse por el servidor.

<img src="img/111.png">

Ahora añadimos este usuario a la lista chroot_list y guardamos los cambios.

Tenemos que resetear de nuevo el servidor:

<img src="img/2222.png">

<img src="img/333.png">

Y al conectarnos con este usuario, vemos que ahora sí puede salir de su directorio.

<img src="img/444.png">

### Denegar acceso a Usuarios

Ahora vamos a denegarle la conexión a otros usuarios, por lo que creamos un par de usuarios nuevos:

`sudo useradd <nombredeusuario>`

<img src="img/4444.png">

Para eso, modificamos el archivo de configuración otra vez:

`sudo nano /etc/vsftpd.conf`

Y nos aseguramos de que estén estas líneas, o las creamos:

`userlist_enable=YES`

`userlist_deny=YES`

`userlist_file=/etc/vsftpd.user_list`

<img src="img/negaraccceso1.png">

Ahora creamos un archivo llamado `vsftpd.user_list` en el directorio `/etc/ para añadir a los usuarios a los que queramos quitarles el acceso a la conexión, y los añadimos:

<img src="img/na1.png">

De nuevo, reiniciarmos el servidor:

`sudo service vsftpd restart`

`sudo service vsftpd status`

<img src="img/na2.png">

Probamos a intentar conectarnos con el usuario que hemos añadido a esta lista:

<img src="img/na3.png">

Y el otro:

<img src="img/na4.png">

Efectivamente, no podemos conectarnos con estos usuarios.
Sin embargo, eliminamos a uno de esta lista, y ahora sí permite la conexión.

<img src="img/na5.png">