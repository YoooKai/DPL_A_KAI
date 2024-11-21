# Instalación y Configuración de VSFTPD

1. Limpieza de Instalaciones Anteriores

Si has intentado instalar o configurar vsftpd previamente, elimina cualquier rastro con:

`sudo apt remove --purge vsftpd`

<img src="img/1.png">



2. Instalación del Paquete vsftpd

Instala el servidor FTP ejecutando:

`sudo apt install vsftpd`

<img src="img/2.png">

3. Verifica el Estado del Servicio


Para comprobar que el servicio se ha instalado y está activo:

`sudo service vsftpd status`

<img src="img/3.png">

4. Configurar la IP del Servidor

Determina la IP de tu servidor con:

`ip a`

Anota la dirección inet de la interfaz correspondiente.


<img src="img/4.png">


5- Ahora, tenemos que entrar al archivo de configuración y escribir lo siguiente, utilizando la ip que sacamos anteriormente para que el servidor sepa a que ip tiene que atender. En este caso como el cliente tiene la misma que el servidor al ser una máquina virtual, escribo el mismo.
Para acceder al archivo escribimos:

`sudo nano /etc/netplan/00-installer-config.yaml`

<img src="img/2024-11-21_18-11.png">

6- Aplicamos los cambios con `sudo netplan apply`
nos da unos avisos pero realiza los cambios.

<img src="img/2024-11-21_18-18.png">

## Configuración Básica

Edita el archivo de configuración de vsftpd

`sudo nano /etc/vsftpd.conf`

Es importante poner la red en red interna en el servidor y en el cliente antes de realizar estos pasos.

Modifica o añade las siguientes líneas
Esto permite conexiones anónimas y especifica un directorio raíz para usuarios anónimos.

`anonymoys_enable=YES`

<img src="img/paso11.png">

También es importante escribir:

`anon_root=/srv/ftp/anonimo`

<img src="img/paso2.png">

Y ahora con la IP y el usuario anonymous deberíamos poder conectarnos en filezilla.

6. Permitir Usuarios Locales y Escritura

Para habilitar a los usuarios locales y permitir que puedan escribir en sus directorios:

Edita el archivo de configuración:

`sudo nano /etc/vsftpd.conf`

Añade o cambia las siguientes líneas:

`local_enable=YES`

`write_enable=YES`

`local_umask=022`

<img src="img/imp.png">

Reinicia el servidor:

`sudo service vsftpd restart`

Nos conectamos con nuestro usuario administrador en filezilla:

<img src="img/2024-11-21_18-26.png">

Vemos que podemos entrar y mover y los archivos. Por ejemplo, movemos el archivo administrador.txt

<img src="img/2024-11-21_18-27.png">

<img src="img/2024-11-21_18-28.png">


## Otras configuraciones:

### Cambiar el mensaje al conectarse al servidor.
Es muy sencillo, solo tenemos que encontrar esta línea en el archivo de configuración, y escribir lo que queramos:
`ftpd_banner=Welcome to my FTP server`

<img src="img/mensaje1.png">

Reiniciamos el servidor.

<img src="img/mensaje2.png">

Y nos conectamos para ver el mensaje:

`ftp 10.0.2.15`

<img src="img/mensaje3.png">

## Activar el fichero de los logs
Por si ocurre algún error, esto quedará registrado.
Habilitamos esta línea.

`xferlog_file=/var/log/vsftpd.log`

<img src="img/log1.png">

Y para probarlo, vamos a ver las últimas 10 líneas del archivo de logs.

`sudo tail -n 10 /var/log/vsftpd.log`

<img src="img/log2.png">

## Cerrar la conexión cuando haya ocurrido determinado tiempo
Para que no se quede conectado indefinidamente, podemos configurar el tiempo de inactividad.
`idle_session_timeout=10`

Ponemos 10, que son 10 segundos para probar, y luego ya ponemos el tiempo que queramos.


<img src="img/timeout1.png">

Reiniciamos el servidor:

<img src="img/timeout2.png">

Y pasados esos segundos, no ha cerrado la conexión como indica el mensaje de estado en filezilla.

<img src="img/timeout3.png">

Generar certificado autofirmado que cifre las conexiones para que sea más seguero el servidor ftp.
Para ello utilizamos el siguiente comando:

`openssl req -x509 -nodes -newkey rsa:2048 -keyout /etc/ssl/private/sftpd.pem -out /etc/ssl/certs/vsftpd.pem -days 365
`
Nos pedirá unos datos nuestros:


<img src="img/certificado1.png">

También debemos modificar el archivo de configuración y cambiar esstas líneas:

`rsa_cert_file=/etc/ssl/certs/ssl-cert-snakeoil.pem`
`rsa_private_key_file=/etc/ssl/private/ssl-cert-snakeoil.key`
`ssl_enable=NO`

<img src="img/certificado2.png">

Por estas otras:

`rsa_cert_file=/etc/ssl/certs/vsftpd.pem`
`rsa_private_key_file=/etc/ssl/private/vsftpd.pem`
`ssl_enable=YES`

<img src="img/cert3.png">
Reiniciamos el servidor y, con el siguiente comando podemos comprobar que se ha generado el certificado autofirmado:

`openssl rsa -in /etc/ssl/private/vsftpd.pem -check`

<img src="img/cert4.png">

Ahora cuando nos conectemos al servidor, nos aparecerá el mensaje y una confirmación.
